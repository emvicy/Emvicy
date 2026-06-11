<?php

namespace App\Table;

use App\DataType\DTAppTableGroup;
use MVC\DataType\DTDBWhere;
use MVC\DB\Model\Db;
use MVC\DB\Trait\TraitDbInit;
use MVC\Event;
use MVC\Strings;

class Group extends Db
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
            'name'          => "varchar(255)    COLLATE utf8_general_ci NOT NULL    UNIQUE  COMMENT 'Group'",
            'gid'           => "int(6)          DEFAULT '1000'          NOT NULL            COMMENT 'GID'",
            'active'        => "int(1)          DEFAULT '0'             NOT NULL            COMMENT 'active'",
            'uuid'          => "varchar(36)     COLLATE utf8_general_ci NOT NULL    UNIQUE  COMMENT 'uuid permanent'",
            "description"   => "text            DEFAULT ''              NOT NULL            COMMENT 'Description'",
        );

        // run setup after "createTable"
        Event::bind('mvc.db.model.db.createTable.after', function ($oDTValue) {
            // this table
            if ($this->sTableName === $oDTValue->get_mValue()['sTable']) {self::setup($this->sTableName);}
        });

        // basic creation of the table
        parent::__construct(
            $this->aField,
            $aDbConfig
        );
    }

    //------------------------------------------------------------------------------------------------------------------

    /**
     * @param string $sTablename
     * @return void
     * @throws \ReflectionException
     */
    public static function setup(string $sTablename = ''): void
    {
        $sDateTime = date('Y-m-d H:i:s');
        $sSql = "
            INSERT INTO `" . $sTablename . "` 
                (`id`, `description`, `gid`, `name`, `active`, `uuid`, `stampChange`, `stampCreate`)
            VALUES 
                (1, '', 0, 'root', 1, '" . Strings::uuid4() . "', '" . $sDateTime . "', '" . $sDateTime . "'),
                (2, '', 100, 'admin', 1, '" . Strings::uuid4() . "', '" . $sDateTime . "', '" . $sDateTime . "'),
                (3, '', 1000, 'user', 1, '" . Strings::uuid4() . "', '" . $sDateTime . "', '" . $sDateTime . "'),
                (4, '', 10000, 'watcher', 1, '" . Strings::uuid4() . "', '" . $sDateTime . "', '" . $sDateTime . "');
        ";

        $oStmt = Db::getDbPdo()->query($sSql);
        $oStmt->closeCursor();
    }
}
