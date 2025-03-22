<?php

namespace MVC;

use App\DataType\DTAppTableQueue;
use MVC\DB\Model\DbCollection;

class Queue
{
    /**
     * pushes a job to the queue
     * @param \App\DataType\DTAppTableQueue $oDTAppTableQueue
     * @param bool                          $bPreventMultipleCreation
     * @return \App\DataType\DTAppTableQueue|null
     * @throws \ReflectionException
     */
    public static function push(DTAppTableQueue $oDTAppTableQueue, bool $bPreventMultipleCreation = false): ?DTAppTableQueue
    {
        return \App\Table\Queue::init( DbCollection::getConfig() )->push($oDTAppTableQueue, $bPreventMultipleCreation);
    }

    /**
     * get job object due to a key and delete it
     * @param string $sKey
     * @param string $sKey2
     * @return \App\DataType\DTAppTableQueue|null
     * @throws \ReflectionException
     */
    public static function pop(string $sKey = '', string $sKey2 = ''): ?DTAppTableQueue
    {
        return \App\Table\Queue::init( DbCollection::getConfig() )->pop($sKey, $sKey2);
    }

    /**
     * pops a concrete job by its id
     * @param int|null $iIdQueue
     * @return \App\DataType\DTAppTableQueue
     * @throws \ReflectionException
     */
    public static function popOnId(?int $iIdQueue = null): DTAppTableQueue
    {
        /** @var DTAppTableQueue $oDTAppTableQueue */
        $oDTAppTableQueue = \App\Table\Queue::init( DbCollection::getConfig() )->getOnId($iIdQueue);

        if (false === empty($oDTAppTableQueue->get_id()))
        {
            \App\Table\Queue::init( DbCollection::getConfig() )->deleteTupel($oDTAppTableQueue);
        }

        return $oDTAppTableQueue;
    }

    /**
     * get time based next job array object without deleting it (just inform)
     * @param int                            $iLimit
     * @param \MVC\DataType\DTDBWhere[]      $aDTDBWhere
     * @return \App\DataType\DTAppTableQueue[]
     * @throws \ReflectionException
     */
    public static function next(int $iLimit = 1, array $aDTDBWhere = array()): array
    {
        return \App\Table\Queue::init( DbCollection::getConfig() )->next($iLimit, $aDTDBWhere);
    }

    /**
     * @param string $sKey
     * @param string $sKey2
     * @return \App\DataType\DTAppTableQueue[]|null
     * @throws \ReflectionException
     */
    public static function popAll(string $sKey = '', string $sKey2 = ''): ?array
    {
        return \App\Table\Queue::init( DbCollection::getConfig() )->popAll($sKey, $sKey2);
    }

    /**
     * @return array
     * @throws \ReflectionException
     */
    public static function getAllKeys(): array
    {
        return \App\Table\Queue::init( DbCollection::getConfig() )->getAllKeys();
    }

    /**
     * @param string $sKey
     * @param string $sKey2
     * @return bool
     * @throws \ReflectionException
     */
    public static function keyExists(string $sKey = '', string $sKey2 = ''): bool
    {
        return \App\Table\Queue::init( DbCollection::getConfig() )->keyExists($sKey, $sKey2);
    }

    /**
     * @param string $sKey
     * @return int
     * @throws \ReflectionException
     */
    public static function getAmount(string $sKey = ''): int
    {
        return \App\Table\Queue::init( DbCollection::getConfig() )->getAmount($sKey);
    }

    /**
     * @return void
     * @throws \ReflectionException
     */
    public static function expire(): void
    {
        \App\Table\Queue::init( DbCollection::getConfig() )->expire();
    }
}
