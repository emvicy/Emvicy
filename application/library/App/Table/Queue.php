<?php

namespace App\Table;

use App\DataType\DTAppTableQueue;
use MVC\DataType\DTDBOption;
use MVC\DataType\DTDBWhere;
use MVC\DataType\DTDBWhereRelation;
use MVC\DB\Model\Db;
use MVC\DB\Trait\TraitDbInit;
use MVC\Event;

class Queue extends Db
{
    use TraitDbInit;

    /**
     * @var array
     */
    protected array $aField = array();

    /**
     * @param array $aDbConfig
     * @throws \ReflectionException
     */
    public function __construct(array $aDbConfig = array())
    {
        $this->aField = array(
            'key'           => "varchar(255)    DEFAULT 'default'   NOT NULL    COMMENT 'key'",
            'key2'          => "varchar(255)    DEFAULT ''          NULL        COMMENT 'optional'",
            'value'         => "mediumtext                          NOT NULL    COMMENT 'value'",
            'valueMd5'      => "varchar(32)                         NOT NULL    COMMENT 'md5 on value'",
            'expirySeconds' => "int(10)         DEFAULT             NULL NULL   COMMENT 'expiry seconds'",
            'expiryStamp'   => "int(10)                             NULL        COMMENT 'expiry timestamp'",
            "description"   => "text            DEFAULT ''          NULL        COMMENT 'Description'",
        );

        // basic creation of the table
        parent::__construct(
            $this->aField,
            $aDbConfig
        );
    }

    /**
     * stores a value on the specified key
     * @param \App\DataType\DTAppTableQueue $oDTAppTableQueue
     * @param bool                               $bPreventMultipleCreation
     * @return \App\DataType\DTAppTableQueue|null
     * @throws \ReflectionException
     */
    public function push(DTAppTableQueue $oDTAppTableQueue, bool $bPreventMultipleCreation = false): ?DTAppTableQueue
    {
        if (true === empty($oDTAppTableQueue->get_key()) || true === empty($oDTAppTableQueue->get_value()))
        {
            return null;
        }

        $this->expire();
        $sDateTime = date('Y-m-d H:i:s');

        (true === empty($oDTAppTableQueue->get_stampCreate()))
            ? $oDTAppTableQueue->set_stampCreate($sDateTime)
            : false;
        (true === empty($oDTAppTableQueue->get_stampChange()))
            ? $oDTAppTableQueue->set_stampChange($sDateTime)
            : false;

        $iExpirySeconds = (
            (false === empty($oDTAppTableQueue->get_expirySeconds()) && abs($oDTAppTableQueue->get_expirySeconds()) > 0)
            ? abs($oDTAppTableQueue->get_expirySeconds())
            : null
        );
        // current timestamp + expire seconds
        $iExpiryStamp = (
            time() + (
            ($iExpirySeconds > 0)
                ? $iExpirySeconds
                : 0
            )
        );
        $oDTAppTableQueue
            ->set_expiryStamp(
                (false === empty($oDTAppTableQueue->get_expiryStamp()))
                    // expiryStamp value given
                    ? $oDTAppTableQueue->get_expiryStamp()
                    // expiryStamp calculated
                    : (
                        ($iExpirySeconds > 0)
                            ? $iExpiryStamp
                            : null
                    )
            )
            ->set_expirySeconds($iExpirySeconds)
        ;
        $oDTAppTableQueue->set_valueMd5(md5($oDTAppTableQueue->get_value()));

        // "Prevention of duplicate creation" is wanted
        if (true === $bPreventMultipleCreation)
        {
            // deny if such a job already exists (exactly same: key,key2,valueMd5)
            if (true === $this->_jobAlreadyExists($oDTAppTableQueue))
            {
                return null;
            }
        }

        Event::run('app.table.queue.push.before', $oDTAppTableQueue);

        /** @var DTAppTableQueue $oDTAppTableQueue */
        $oDTAppTableQueue = $this->create(
            // queue data object
            $oDTAppTableQueue,
            // false: use recent id if there is any | true: auto increment
            bAutoIncrementId: (true === empty($oDTAppTableQueue->get_id()))
        );

        Event::run('app.table.queue.push.after', $oDTAppTableQueue);

        return $oDTAppTableQueue;
    }

    /**
     * dequeues ONE (the oldest) value along to the given key; it returns the tupel, also deletes the tupel
     * @param string $sKey
     * @param string $sKey2 optional
     * @return \App\DataType\DTAppTableQueue|false|null
     * @throws \ReflectionException
     */
    /**
     * @param string $sKey
     * @param string $sKey2
     * @return \App\DataType\DTAppTableQueue|null
     * @throws \ReflectionException
     */
    public function pop(string $sKey = '', string $sKey2 = ''): ?DTAppTableQueue
    {
        Event::run('app.table.queue.pop.before', $sKey);

        if (true === empty($sKey))
        {
            return null;
        }

        $this->expire();
        $aDTDBWhere = array();

        if (false === empty($sKey))
        {
            $aDTDBWhere = [DTDBWhere::create()->set_sKey(DTAppTableQueue::getPropertyName_key())->set_sValue($sKey)];
        }

        // Jobs mit ältesten change datum zuerst
        $aDTDBOption = [DTDBOption::create()->set_sValue("ORDER BY `stampChange` ASC LIMIT 0, 1")];

        // add key2 if so
        if (false === empty($sKey2))
        {
            $aDTDBWhere[] = DTDBWhere::create()->set_sKey(DTAppTableQueue::getPropertyName_key2())->set_sValue($sKey2);
        }

        /** @var \App\DataType\DTAppTableQueue|false $oDTAppTableQueue */
        $oDTAppTableQueue = current($this->retrieve(
            $aDTDBWhere,
            $aDTDBOption,
        ));

        (false === $oDTAppTableQueue) ? $oDTAppTableQueue = null : false;

        if (false === empty($oDTAppTableQueue))
        {
            $this->deleteTupel($oDTAppTableQueue);
        }

        Event::run('app.table.queue.pop.after', $oDTAppTableQueue);

        return $oDTAppTableQueue;
    }

    /**
     * @param int                            $iLimit
     * @param \MVC\DataType\DTDBWhere[]      $aDTDBWhere
     * @return \App\DataType\DTAppTableQueue[]
     * @throws \ReflectionException
     */
    public function next(int $iLimit = 1, array $aDTDBWhere = array()): array
    {
        $this->expire();

        /** @var \App\DataType\DTAppTableQueue[] $aDTAppTableQueue */
        $aDTAppTableQueue = $this->retrieve(
            $aDTDBWhere,
            [DTDBOption::create()->set_sValue("ORDER BY `stampChange` ASC LIMIT 0, " . $iLimit)],
        );

        return $aDTAppTableQueue;
    }

    /**
     * dequeues all values according to the specified keys; it returns all tuples, also deletes all tuples
     * @param string $sKey
     * @param string $sKey2
     * @return \App\DataType\DTAppTableQueue[]|null
     * @throws \ReflectionException
     */
    public function popAll(string $sKey = '', string $sKey2 = ''): ?array
    {
        Event::run('app.table.queue.popall.before', $sKey);

        if (true === empty($sKey))
        {
            return null;
        }

        $this->expire();
        $aDTDBWhere = [DTDBWhere::create()->set_sKey(DTAppTableQueue::getPropertyName_key())->set_sValue($sKey)];

        // add key2 if so
        if (false === empty($sKey2))
        {
            $aDTDBWhere[] = DTDBWhere::create()->set_sKey(DTAppTableQueue::getPropertyName_key2())->set_sValue($sKey2);
        }

        /** @var DTAppTableQueue[] $aDTAppTableQueue */
        $aDTAppTableQueue = $this->retrieve(
            $aDTDBWhere
        );

        foreach ($aDTAppTableQueue as $oDTAppTableQueue)
        {
            $this->deleteTupel($oDTAppTableQueue);
        }

        Event::run('app.table.queue.popall.after', $aDTAppTableQueue);

        return $aDTAppTableQueue;
    }

    /**
     * @return array
     * @throws \ReflectionException
     */
    public function getAllKeys(): array
    {
        $this->expire();

        return array_map(
            function ($mValue) {
                return$mValue[DTAppTableQueue::getPropertyName_key()];
            },
            Db::getDbPdo()->fetchAll("
                SELECT DISTINCT `" . DTAppTableQueue::getPropertyName_key() . "` 
                FROM `" . $this->sTableName . "` 
                WHERE 1 
                ORDER BY `" . DTAppTableQueue::getPropertyName_key() . "` ASC"
            )
        );
    }

    /**
     * @param string $sKey
     * @param string $sKey2 optional
     * @return bool
     * @throws \ReflectionException
     */
    public function keyExists(string $sKey = '', string $sKey2 = ''): bool
    {
        if (true === empty($sKey))
        {
            return false;
        }

        $this->expire();

        $aDTWhere = array(
            DTDBWhere::create()->set_sKey(DTAppTableQueue::getPropertyName_key())->set_sValue($sKey),
        );

        if (false === empty($sKey2))
        {
            $aDTWhere[] = DTDBWhere::create()->set_sKey(DTAppTableQueue::getPropertyName_key2())->set_sValue($sKey2);
        }

        $aDTAppTableQueue = $this->retrieve($aDTWhere);

        return (false === empty($aDTAppTableQueue));
    }

    /**
     * @param string $sKey
     * @return int
     * @throws \ReflectionException
     */
    public function getAmount(string $sKey = ''): int
    {
        if (true === empty($sKey))
        {
            return 0;
        }

        $this->expire();

        return $this->count([
            DTDBWhere::create()->set_sKey(DTAppTableQueue::getPropertyName_key())->set_sValue($sKey),
        ]);
    }

    /**
     * @return void
     * @throws \ReflectionException
     */
    public function expire(): void
    {
        $iTime = time();
        $iAmount = $this->count([
            DTDBWhere::create()->set_sKey(DTAppTableQueue::getPropertyName_expiryStamp())->set_sRelation(DTDBWhereRelation::smallerThan)->set_sValue($iTime),
        ]);

        // nothing to do
        if (0 === $iAmount)
        {
            return;
        }

        Event::run('app.table.queue.expire.before', $iTime);

        $sSql = "
            DELETE FROM `" . $this->sTableName . "` 
            WHERE 1 
            AND `" . DTAppTableQueue::getPropertyName_expiryStamp() . "` < '" . $iTime . "'
        ";

        Db::getDbPdo()->query($sSql);

        Event::run('app.table.queue.expire.after', $iTime);
    }

    /**
     * @param \App\DataType\DTAppTableQueue $oDTAppTableQueue
     * @return bool
     * @throws \ReflectionException
     */
    protected function _jobAlreadyExists (DTAppTableQueue $oDTAppTableQueue): bool
    {
        $sSql = "SELECT COUNT(id) AS iAmount FROM `" . $this->sTableName . "` \n";
        $sSql.= "WHERE 1\n";
        $sSql.= "AND `key` = '" . $oDTAppTableQueue->get_key() . "' \n";

        (true === empty($oDTAppTableQueue->get_key2()))
            ? $sSql.= "AND (`key2` = '" . $oDTAppTableQueue->get_key2() . "' OR `key2` IS NULL) \n"
            : $sSql.= "AND `key2` = '" . $oDTAppTableQueue->get_key2() . "' \n"
        ;

        $sSql.= "AND `valueMd5` = '" . $oDTAppTableQueue->get_valueMd5() . "' \n";
        $iAmount = (int) Db::getDbPdo()->fetchRow($sSql)['iAmount'];

        return (bool) $iAmount;
    }
}