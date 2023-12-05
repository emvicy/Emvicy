<?php
/**
 * Db.php
 *
 * @package Emvicy
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <emvicy@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

/**
 * @name $DBModel
 */
namespace MVC\DB\Model;

use MVC\ArrDot;
use MVC\Config;
use MVC\DataType\DTDBSet;
use MVC\DataType\DTDBWhere;
use MVC\DataType\DTValue;
use MVC\DB\DataType\DB\Constraint;
use MVC\DB\DataType\DB\Foreign;
use MVC\DB\DataType\DB\TableDataType;
use MVC\Cache;
use MVC\DataType\DTArrayObject;
use MVC\DataType\DTKeyValue;
use MVC\Debug;
use MVC\Error;
use MVC\Event;
use MVC\Generator\DataType;
use MVC\Log;
use MVC\Registry;
use MVC\Route;
use function PHPUnit\Framework\isEmpty;

/**
 * Class Db
 * @package DB\Model
 */
class Db
{
    /**
     * @var string
     */
    public $sTableName = '';

    /**
     * @var string
     */
    public $sCacheKeyTableName = '';

    /**
     * @var string
     */
    public $sCacheValueTableName = '';

    /**
     * @var array
     */
    public $aFieldArrayComplete = array();

    /**
     * @var \MVC\DB\Model\DbPDO
     */
    public $oDbPDO;

    /**
     * @var bool
     */
    public static $bCaching = true;

    /**
     * @see README.md
     * @var array
     */
    public $aConfig = array();

    /**
     * @var array
     */
    public $aForeign = array();

    /**
     * These Fieldnames are reserved and may not be part of setup
     * as they will be created and added automatically.
     * You can override this behaviour by using method `setReservedFieldNameArray()` and passing
     * an empty array to it: $oDb->setReservedFieldNameArray(array());
     * @var array
     */
    public $aReservedFieldName = array(
        'id',
        'stampChange',
        'stampCreate',
    );

    /**
     * array of sql types and their php equivalents
     * @var array
     */
    public static $aSqlType = array(
        'char' => 'string',
        'varchar' => 'string',
        'binary' => 'string',
        'varbinary' => 'string',
        'tinyblob' => 'string',
        'blob' => 'string',
        'mediumblob' => 'string',
        'longblob' => 'string',
        'tinytext' => 'string',
        'text' => 'string',
        'mediumtext' => 'string',
        'longtext' => 'string',
        'enum' => 'string',
        'set' => 'string',

        'date' => 'string',
        'time' => 'string',
        'datetime' => 'string',
        'timestamp' => 'string',
        'year' => 'string',

        'tinyint' => 'int',
        'smallint' => 'int',
        'mediumint' => 'int',
        'int' => 'int',
        'bigint' => 'int',
        'float' => 'float',
        'double' => 'double',

        'bit' => 'boolean',
        'boolean' => 'boolean',
        'bool' => 'boolean',

        'geometry' => 'string',
        'point' => 'string',
        'linestring' => 'string',
        'polygon' => 'string',
        'geometrycollection' => 'string',
        'multilinestring' => 'string',
        'multipoint' => 'string',
        'multipolygon' => 'string',

        'json' => 'string',
    );

    /**
     * Db constructor.
     * @param array $aFields
     * @param array $aDbConfig
     * @param array $aAlterTable
     * @throws \ReflectionException
     */
    public function __construct ($aFields = array(), $aDbConfig = array(), $aAlterTable = array())
    {
        $this->aFieldArrayComplete = $aFields;
        $this->aConfig = $aDbConfig;
        $this->sTableName = self::createTableName(get_class($this));
        $this->sCacheKeyTableName = __CLASS__ . '.' . $this->sTableName;
        $this->sCacheValueTableName = func_get_args();

        Log::write(__METHOD__, $this->sTableName . '.log');

        // init DB
        $sRegistryKey = self::createTableName(__CLASS__) . '.DbPDO';

        if (Registry::isRegistered($sRegistryKey))
        {
            $this->oDbPDO = Registry::get($sRegistryKey);
        }
        else
        {
            $this->oDbPDO = new DbPDO($this->aConfig);
            Registry::set($sRegistryKey, $this->oDbPDO);
        }

        $this->setCachingState();
        $this->setSqlLoggingState();

        if ($this->sCacheValueTableName !== Cache::getCache($this->sCacheKeyTableName))
        {
            (false === filter_var($this->checkIfTableExists ($this->sTableName), FILTER_VALIDATE_BOOLEAN))
                ? $this->createTable($this->sTableName, $aFields, $aAlterTable)
                : false;

            if (true === self::$bCaching)
            {
                Event::run('mvc.db.model.db.construct.saveCache', $this->sTableName);
                Cache::saveCache(
                    $this->sCacheKeyTableName,
                    $this->sCacheValueTableName
                );
            }
        }
    }

    /**
     * Sets Caching state due to config
     * @return void
     */
    protected function setCachingState() : void
    {
        self::$bCaching = (isset($this->aConfig['caching']['enabled'])) ? $this->aConfig['caching']['enabled'] : false;
    }

    /**
     * Sets SQL state due to config
     * @return void
     * @throws \ReflectionException
     */
    protected function setSqlLoggingState() : void
    {
        $sSql = '';
        (isset($this->aConfig['logging']['log_output'])) ? $sSql.= "SET GLOBAL log_output = '" . strtoupper($this->aConfig['logging']['log_output']) . "';" : false;
        (isset($this->aConfig['logging']['general_log'])) ? $sSql.= "SET GLOBAL general_log = '" . strtoupper($this->aConfig['logging']['general_log']) . "';" : false;
        (isset($this->aConfig['logging']['general_log_file'])) ? $sSql.= "SET GLOBAL general_log_file = '" . $this->aConfig['logging']['general_log_file'] . "';" : false;
        $oStmt = $this->oDbPDO->prepare($sSql);

        try
        {
            $oStmt->execute();
        }
        catch (\Exception $oException)
        {
            \MVC\Error::exception($oException);
        }
    }

    /**
     * @param \MVC\DB\DataType\DB\Foreign $oDtDbForeign
     * @return bool
     * @throws \ReflectionException
     */
    protected function setForeignKey(Foreign $oDtDbForeign) : bool
    {
        // add foreign to class property
        $this->aForeign[$oDtDbForeign->get_sForeignKey()] = $oDtDbForeign;

        // already exists
        if (false !== $this->getFieldInfo($oDtDbForeign->get_sForeignKey()))
        {
            return false;
        }

        $sSql = "
            ALTER TABLE `" . $this->sTableName . "`
                ADD `" . $oDtDbForeign->get_sForeignKey() . "` " . $oDtDbForeign->get_sForeignKeySQL() . ";

            ALTER TABLE `" . $this->sTableName . "`
                ADD INDEX `" . $oDtDbForeign->get_sForeignKey() . "` (`" . $oDtDbForeign->get_sForeignKey() . "`);

            ALTER TABLE `" . $this->sTableName . "`
                ADD CONSTRAINT FOREIGN KEY (`" . $oDtDbForeign->get_sForeignKey() . "`)
                REFERENCES `" . $oDtDbForeign->get_sReferenceTable() . "` (`" . $oDtDbForeign->get_sReferenceKey() . "`)
                " . $oDtDbForeign->get_sOnDelete() . " " . $oDtDbForeign->get_sOnUpdate() . ";";

        $sCacheKey = __METHOD__ . '.' . $this->sTableName . '.' . md5(serialize($oDtDbForeign));

        // add to final, completed  field array
        if (false === in_array($oDtDbForeign->get_sForeignKey(), $this->aFieldArrayComplete))
        {
            $this->aFieldArrayComplete[$oDtDbForeign->get_sForeignKey()] = $oDtDbForeign->get_sForeignKey();
        }

        if ($sSql !== Cache::getCache($sCacheKey))
        {
            $oStmt = $this->oDbPDO->prepare($sSql);

            try
            {
                $oStmt->execute();
            }
            catch (\Exception $oException)
            {
                \MVC\Error::exception($oException);
                return false;
            }

            Cache::saveCache(
                $sCacheKey,
                $sSql
            );
        }

        return true;
    }

    /**
     * @param array $aReservedFieldName
     * @return void
     */
    protected function setReservedFieldNameArray(array $aReservedFieldName = array()) : void
    {
        $this->aReservedFieldName = $aReservedFieldName;
    }

    /**
     * @return array|string[]
     */
    protected function getReservedFieldNameArray() : array
    {
        return $this->aReservedFieldName;
    }

    /**
     * generates a DataType Class on the DB Table
     * @return bool
     * @throws \ReflectionException
     */
    protected function generateDataType() : bool
    {
        list($sModulename) = explode('\\', get_class($this));
        $sClassName = $this->getGenerateDataTypeClassName();

        $aDTConfig = array(
            'dir' => Registry::get('MVC_MODULES_DIR') . '/' . $sModulename . '/DataType/',
            'unlinkDir' => false,
            'createEvents' => true,
            'class' => array(array(
                                 'name' => $sClassName,
                                 'file' => $sClassName . '.php',
                                 'extends' => '\\MVC\\DB\\DataType\\DB\\TableDataType',
                                 'namespace' => $sModulename . '\DataType',
                                 'constant' => array(),
                                 'property' => array(),
                             )),
        );

        $aTableDataTypeProperty = array_keys(TableDataType::create()->getPropertyArray());
        $aField = $this->getFieldInfo('', false);

        foreach ($aField as $sKey => $aValue)
        {
            // skip building properties which are already part of extended class
            if (in_array($sKey, $aTableDataTypeProperty))
            {
                continue;
            }

            $aSetTmp = array(
                'key' => $sKey,
                'var' => $aValue['_php'],
                'required' => true,
                'forceCasting' => true,
            );
            (true === (('yes' === strtolower(get($aValue['Null']))) ? true : false)) ? $aSetTmp['value'] = 'null' : false;
            $aDTConfig['class'][0]['property'][] = $aSetTmp;
        }

        $bSuccess = DataType::create()->initConfigArray($aDTConfig);

        return $bSuccess;
    }

    /**
     * @return string
     */
    protected function getGenerateDataTypeClassName() : string
    {
        $sClassName = (string) str_replace('\\', '', str_replace('_', '', 'DT' . get_class($this)));

        return $sClassName;
    }

    /**
     * @return array|string[]
     */
    public static function getSqlTypeArray() : array
    {
        return self::$aSqlType;
    }

    /**
     * @param array $aField
     * @return bool equal
     */
    protected function bFieldsAreEqual(array $aField = array()) : bool
    {
        $aParamFieldKey = array_keys($aField);
        $aDbFieldKey = array_keys($this->getFieldInfo());
        $mDiff1 = array_diff($aParamFieldKey, $aDbFieldKey);
        $mDiff2 = array_diff($aDbFieldKey, $aParamFieldKey);

        return (empty($mDiff1) && empty($mDiff2));
    }

    /**
     * @param $sTable
     * @return bool
     * @throws \ReflectionException
     */
    protected function checkIfTableExists ($sTable) : bool
    {
        try
        {
            // Select 1 from table_name will return false if the table does not exist.
            $aResult = $this->oDbPDO->fetchAll("DESCRIBE `" . $sTable . "`");
        }
        catch (\Exception $oException)
        {
            Error::exception($oException);

            return false;
        }

        if (empty($aResult))
        {
            return false;
        }

        return true;
    }

    /**
     * Creates InnoDB Table
     * @example $aFields
     * array(
     *      , 'url'                 => 'varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL'
     *      , 'dateTimeInvalid'     => 'datetime'
     *      , 'jsonContext'         => 'text'
     *      , 'deliverable'         => 'int(1)'
     *      , 'dateTimeDelivered'   => 'datetime'
     * );
     * @param string $sTable
     * @param array  $aFields
     * @param array  $aAlterTable
     * @return false|\PDOStatement
     * @throws \ReflectionException
     */
    protected function createTable(string $sTable = '', array $aFields = array(), array $aAlterTable = array()) : false|\PDOStatement
    {
        $mState = false;

        $oDTValue = DTValue::create()->set_mValue(array('sTable' => $sTable, 'aFields' => $aFields, 'aAlterTable' => $aAlterTable));
        Event::run('mvc.db.model.db.createTable.before', $oDTValue);
        $sTable = $oDTValue->get_mValue()['sTable'];
        $aFields = $oDTValue->get_mValue()['aFields'];
        $aAlterTable = $oDTValue->get_mValue()['aAlterTable'];

        // drop, create, add id
        $sSql = "
            DROP TABLE IF EXISTS `" . $sTable . "`;
            CREATE TABLE IF NOT EXISTS `" . $sTable . "` (
            `id` int(11) NOT NULL AUTO_INCREMENT,
            ";

        // iterate fields
        foreach ($aFields as $sKey => $sValue)
        {
            // skip these
            if (in_array($sKey, $this->aReservedFieldName))
            {
                continue;
            }

            $sSql.= "`" . $sKey . "` " . $sValue . ",\n";
        }

        // add stamps + set primary key
        $sSql.= "`stampChange` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
				`stampCreate` timestamp NOT NULL DEFAULT '" . date ('Y-m-d H:i:s') . "',
				PRIMARY KEY (`id`)";

        // set engine
        $sSql.="\n) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC;";

        // additional commands
        foreach ($aAlterTable as $sValue)
        {
            $sSql.= "ALTER TABLE `" . $sTable . "` ADD " . $sValue . ";\n";
        }

        $oSql = new ArrDot();
        $oSql->set('sSql', str_replace("\n", ' ', stripslashes($sSql)));
        Event::run('mvc.db.model.db.createTable.sql', $oSql);

        try
        {
            $mState = $this->oDbPDO->query($sSql);
        }
        catch (\Exception $oException)
        {
            \MVC\Error::exception($oException);
        }

        return $mState;
    }

    /**
     * @return bool
     * @throws \ReflectionException
     */
    protected function synchronizeFields() : bool
    {
        $sSql = "SHOW FULL COLUMNS FROM " . $this->sTableName;

        try
        {
            $aColumn = $this->oDbPDO->fetchAll ($sSql);
        }
        catch (\Exception $oException)
        {
            \MVC\Error::exception($oException);

            return false;
        }

        if (empty($aColumn))
        {
            return false;
        }

        $aColumnAssoc = array();

        foreach ($aColumn as $aValue)
        {
            $aColumnAssoc[$aValue['Field']] = $aValue;
        }

        $aColumnFinal = array();

        foreach ($aColumn as $aValue)
        {
            if (!in_array ($aValue['Field'], self::getReservedFieldNameArray()))
            {
                $aColumnFinal[$aValue['Field']] = $aValue;
            }
        }

        $sCacheSyncKey = __METHOD__ . '.' . $this->sTableName;
        $sCacheSyncValue = serialize($aColumnFinal) . '.' . serialize($this->sCacheValueTableName);

        if ($sCacheSyncValue === Cache::getCache($sCacheSyncKey))
        {
            return true;
        }

        Cache::saveCache($sCacheSyncKey, $sCacheSyncValue);

        $aTableNoForeignKeys = array_diff(array_keys($this->getFieldInfo()), array_keys($this->aForeign));
        $aTableFieldDef = array_keys(get($this->aFieldArrayComplete, []));

        // Delete
        $aDelete = array_diff($aTableNoForeignKeys, $aTableFieldDef);

        // Insert
        $aInsert = [];
        $aInsertTmp = array_diff($aTableFieldDef, $aTableNoForeignKeys);
        foreach ($aInsertTmp as $sInsert) {(isset($this->aField[$sInsert])) ? $aInsert[$sInsert] = $this->aField[$sInsert] : false;}

        DELETE: {

        foreach ($aDelete as $sFieldName)
        {
            $oDTDBConstraint = $this->getConstraintInfo(get($sFieldName, ''));
            $sSql = '';

            if ('' !== $oDTDBConstraint->get_CONSTRAINT_NAME())
            {
                $sSql.= "ALTER TABLE  `" . $this->sTableName  . "` DROP FOREIGN KEY `" . $oDTDBConstraint->get_CONSTRAINT_NAME() . "`;\n";
                $sSql.= "ALTER TABLE  `" . $this->sTableName  . "` DROP INDEX `" . $oDTDBConstraint->get_CONSTRAINT_NAME() . "`;\n";
            }

            $sSql.= "ALTER TABLE  `" . $this->sTableName  . "` DROP  `" . $sFieldName . "`;\n";

            if (false === empty($sSql))
            {
                $oSql = new ArrDot();
                $oSql->set('sSql', str_replace("\n", ' ', stripslashes($sSql)));
                Event::run('mvc.db.model.db.delete.sql', $oSql);

                try
                {
                    $this->oDbPDO->query ($sSql);
                }
                catch (\Exception $oException)
                {
                    \MVC\Error::exception($oException);

                    return false;
                }
            }
        }
    }

        INSERT: {

        foreach ($aInsert as $sKey => $aValue)
        {
            $sSql = "ALTER TABLE  `" . $this->sTableName  . "` ADD  `" . $sKey . "` " . $aValue . " AFTER  `id`\n";

            $oSql = new ArrDot();
            $oSql->set('sSql', str_replace("\n", ' ', stripslashes($sSql)));
            Event::run('mvc.db.model.db.insert.sql', $oSql);

            try
            {
                $this->oDbPDO->query ($sSql);
            }
            catch (\Exception $oException)
            {
                \MVC\Error::exception($oException);

                return false;
            }
        }
    }

        UPDATE: {

        foreach ($this->getFieldArray() as $sKey => $sValue)
        {
            $sSql = "ALTER TABLE `" . $this->sTableName . "` CHANGE  `" . $sKey . "`\n`" . $sKey . "` " . $sValue . ";\n";

            $oSql = new ArrDot();
            $oSql->set('sSql', str_replace("\n", ' ', stripslashes($sSql)));
            Event::run('mvc.db.model.db.update.sql', $oSql);

            try
            {
                $this->oDbPDO->query ($sSql);
            }
            catch (\Exception $oException)
            {
                \MVC\Error::exception($oException);

                return false;
            }
        }
    }

        return true;
    }

    /**
     * returns settings array from extending child class, if set
     * @return array
     */
    protected function getFieldArray() : array
    {
        return (isset($this->aField)) ? $this->aField : array();
    }

    /**
     * @param string $sField
     * @return string
     * @throws \ReflectionException
     */
    public function getComment(string $sField = '') : string
    {
        if (false === empty(get($this->aForeign[$sField])))
        {
            /** @var \MVC\DB\DataType\DB\Foreign $oDTForeign */
            $oDTForeign = get($this->aForeign[$sField]);

            return $oDTForeign->get_sComment();
        }

        return (string) get($this->getFieldInfo($sField)['Comment'], '');
    }

    /**
     * @param string $sFieldName
     * @param bool   $bAvoidReserved
     * @return array
     * @throws \ReflectionException
     */
    public function getFieldInfo(string $sFieldName = '', bool $bAvoidReserved = true) : array
    {
        $aResult = array();
        $sSql = "SHOW FULL COLUMNS FROM " . $this->sTableName;
        $oStmt = $this->oDbPDO->prepare($sSql);
        $oStmt->execute();
        $aFieldName = $oStmt->fetchAll(\PDO::FETCH_ASSOC);
        (false === $aFieldName) ? $aFieldName = [] : false;

        foreach ($aFieldName as $aValue)
        {
            if (true === $bAvoidReserved && in_array($aValue['Field'], $this->aReservedFieldName))
            {
                continue;
            }

            $aResult[$aValue['Field']] = $aValue;
        }

        // add comment from foreigns
        if (!empty(get($this->aForeign[$sFieldName])))
        {
            /** @var \MVC\DB\DataType\DB\Foreign $oDTForeign */
            $oDTForeign = get($this->aForeign[$sFieldName]);

            if (!empty($oDTForeign->get_sComment()))
            {
                $aResult[$sFieldName]['Comment'] = $oDTForeign->get_sComment();
            }
        }

        // add PHP Type equivalents
        foreach ($aResult as $sKey => $mValue)
        {
            $sType = (true === is_array($mValue)) ? get($mValue['Type'], 'varchar') : '';
            $sDefString = $sType;
            $sType = strtolower($sType);
            $sType = trim($sType);
            $sType = trim(strtok($sType, '('));
            $sType = trim(strtok($sType, ' '));
            $sType = preg_replace('/[^a-zA-Z]+/', '', $sType);

            if (isset(self::$aSqlType[$sType]))
            {
                $aResult[$sKey]['_php'] = self::$aSqlType[$sType];
                $aResult[$sKey]['_type'] = $sType;

                $mValueType = '';

                if (in_array($sType, array('char','varchar','int','tinyint','smallint','mediumint','bigint')))
                {
                    $mValueType = self::getIntegerFromType(get($sDefString, ''), $sType);
                }
                elseif ('enum' === $sType)
                {
                    $mValueType = self::getArrayFromEnum(get($sDefString, ''));
                }

                $aResult[$sKey]['_typeValue'] = $mValueType;
            }
        }

        if (false === empty($sFieldName) && false === empty(get($aResult[$sFieldName])))
        {
            return $aResult[$sFieldName];
        }

        return $aResult;
    }

    /**
     * @param string $sValue
     * @param string $sType
     * @return int
     */
    protected static function getIntegerFromType(string $sValue = '', string $sType = 'char') : int
    {
        $sPattern = '/' . $sType . '(\:|\.|\s)*\(([0-9]*)\)/i';
        preg_match_all($sPattern, $sValue, $aMatch);
        $mValue = (int) current($aMatch[2]);

        return $mValue;
    }

    /**
     * @param string $sValue
     * @return array
     */
    protected static function getArrayFromEnum(string $sValue = '') : array
    {
        $sValue = trim($sValue);
        $sPattern = '/enum(\:|\.|\s)*\([\p{L}\p{M}\p{Z}\p{S}\p{N}\p{P}\p{C}]*\)/i';
        preg_match($sPattern, $sValue, $aMatch);
        $sMatch = current($aMatch);
        $sMatch = trim(str_replace('enum', '', $sMatch));
        $sMatch = substr($sMatch, 1, -1);
        $aValue = array_filter(explode(',', $sMatch));
        $aValue = array_map('trim', $aValue);
        $aValue = array_map(
            function ($mValue) {
                return substr($mValue, 1, -1);
            },
            $aValue
        );

        return $aValue;
    }

    /**
     * @param string $sFieldName
     * @return \MVC\DB\DataType\DB\Constraint
     * @throws \ReflectionException
     */
    protected function getConstraintInfo(string $sFieldName = '') : Constraint
    {
        $aConstraint = array();
        $sSql = "
            SELECT
                COLUMN_NAME,
                CONSTRAINT_NAME,
                REFERENCED_COLUMN_NAME,
                REFERENCED_TABLE_NAME
            FROM information_schema.KEY_COLUMN_USAGE
            WHERE 1
            AND TABLE_NAME=:sTableName
            ";
        ('' !== $sFieldName) ? $sSql.= "AND COLUMN_NAME=:sFieldName\n" : false;
        $sSql.= ";";

        $oStmt = $this->oDbPDO->prepare($sSql);
        $oStmt->bindValue(':sTableName', $this->sTableName, \PDO::PARAM_STR);
        ('' !== $sFieldName) ? $oStmt->bindValue(':sFieldName', $sFieldName, \PDO::PARAM_STR) : false;

        try
        {
            $oStmt->execute();
            $aConstraint = ('' === $sFieldName) ? $oStmt->fetchAll(\PDO::FETCH_ASSOC) : $oStmt->fetch(\PDO::FETCH_ASSOC);
            (false === is_array($aConstraint)) ? $aConstraint = array() : false;
        }
        catch (\Exception $oException)
        {
            Error::exception($oException);
        }

        $oDTDBConstraint = new Constraint($aConstraint);

        return $oDTDBConstraint;
    }

    /**
     * @param string $sString
     * @return string
     */
    protected static function createTableName(string $sString = '') : string
    {
        ('' === $sString) ? $sString = __CLASS__ : false;
        $sString = str_replace('\\', '', $sString);
        $sString = str_replace('_', '', $sString);

        return (string) $sString;
    }

    /**
     * @param \MVC\DB\DataType\DB\TableDataType|null $oTableDataType
     * @return \MVC\DB\DataType\DB\TableDataType|null
     * @throws \ReflectionException
     */
    public function create(TableDataType $oTableDataType = null) : TableDataType|null
    {
        if (null === $oTableDataType)
        {
            return $oTableDataType;
        }

        Event::run('mvc.db.model.db.create.before', $oTableDataType);

        $aField = array_keys($oTableDataType->getPropertyArray());

        // STATEMENT
        $sSql = "INSERT INTO `" . $this->sTableName . "` (";
        $sSqlExplain = $sSql;

        foreach ($aField as $iCnt => $sField)
        {
            if ('id' === $sField){continue;}
            $sSql.= "`" . $sField . "`,";
            $sSqlExplain.= "`" . $sField . "`,";;
        }

        $sSqlExplain = rtrim($sSqlExplain, ',');
        $sSql = substr($sSql, 0, -1);
        $sSql.= "\n) VALUES (\n";
        $sSqlExplain.= ") VALUES (";;

        foreach ($aField as $iCnt => $sField)
        {
            if ('id' === $sField){continue;}
            $sSql.= ":" . $sField . ",";
        }

        $sSql = substr($sSql, 0, -1);
        $sSql.= "\n);\n";

        $oStmt = $this->oDbPDO->prepare($sSql);

        // BINDINGS
        foreach ($aField as $sField)
        {
            if ('id' === $sField){continue;}

            $sMethod = 'get_' . $sField;
            $sValue = $oTableDataType->$sMethod();
            $sType = gettype($sValue);

            ('boolean' === $sType) ? $sDataType = \PDO::PARAM_BOOL : false;
            ('integer' === $sType) ? $sDataType = \PDO::PARAM_INT : false;
            ('null' === $sType) ? $sDataType = \PDO::PARAM_NULL : false;
            ('string' === $sType) ? $sDataType = \PDO::PARAM_STR : false;
            (false === isset($sDataType)) ? $sDataType = \PDO::PARAM_STR : false;

            $oStmt->bindValue(
                ':' . $sField,
                $sValue,
                $sDataType
            );
            (null === $sValue) ? $sSqlExplain.= "NULL," : $sSqlExplain.= "'" . $sValue . "',";
        }

        $sSqlExplain = rtrim($sSqlExplain, ',');
        $sSqlExplain.= "); ";

        $oSql = new ArrDot();
        $oSql->set('sSql', str_replace("\n", ' ', stripslashes($sSqlExplain)));
        Event::run('mvc.db.model.db.create.sql', $oSql);

        try
        {
            // Create DB Entries
            $oStmt->execute();
            $iId = $this->oDbPDO->lastInsertId();
            $oTableDataType->set_id($iId);
        }
        catch (\Exception $oExc)
        {
            Error::exception($oExc);
        }

        Event::run('mvc.db.model.db.create.after', $oTableDataType);

        return $oTableDataType;
    }

    /**
     * @return int
     */
    public function checksum() : int
    {
        $sSql = 'CHECKSUM TABLE `' . $this->sTableName . '`';
        $aChecksum = $this->oDbPDO->fetchRow($sSql);

        return (int) get($aChecksum['Checksum']);
    }

    /**
     * @param \MVC\DB\DataType\DB\TableDataType|null $oTableDataType
     * @return \MVC\DB\DataType\DB\TableDataType
     * @throws \ReflectionException
     */
    public function retrieveTupel(TableDataType $oTableDataType = null) : TableDataType
    {
        Event::run('mvc.db.model.db.retrieveTupel.before', $oTableDataType);

        if (0 === $oTableDataType->get_id())
        {
            $sTableDataType = get_class($oTableDataType);
            return $sTableDataType::create();
        }

        $aDTDBWhere = array();
        $aDTDBWhere[] = DTDBWhere::create()
            ->set_sKey(TableDataType::getPropertyName_id())
            ->set_sRelation('=')
            ->set_sValue($oTableDataType->get_id());

        $aResult = $this->retrieve(
            $aDTDBWhere,
            array(),
            get_class($oTableDataType)
        );

        return current($aResult);
    }

    /**
     * @param \MVC\DataType\DTDBWhere[]  $aDTDBWhere
     * @param \MVC\DataType\DTDBOption[] $aDTDBOption
     * @return \MVC\DB\DataType\DB\TableDataType[]
     * @throws \ReflectionException
     */
    public function retrieve(array $aDTDBWhere = array(), array $aDTDBOption = array()) : array
    {
        $oDTValue = DTValue::create()->set_mValue(array('aDTDBWhere' => $aDTDBWhere, 'aDTDBOption' => $aDTDBOption));
        Event::run('mvc.db.model.db.retrieve.before', $oDTValue);
        /** @var \MVC\DataType\DTDBWhere[] $aDTDBWhere */
        $aDTDBWhere = $oDTValue->get_mValue()['aDTDBWhere'];
        /** @var \MVC\DataType\DTDBOption[] $aDTDBOption */
        $aDTDBOption = $oDTValue->get_mValue()['aDTDBOption'];

        #---

        $sSql = "SELECT * FROM `" . $this->sTableName . "` \nWHERE  1\n";
        $sSqlExplain = $sSql;

        /** @var \MVC\DataType\DTDBWhere $oDTDBWhere */
        foreach ($aDTDBWhere as $oDTDBWhere)
        {
            $sSql.= 'AND `' . $oDTDBWhere->get_sKey() . '` ' . $oDTDBWhere->get_sRelation() . ' :' . $oDTDBWhere->get_sKey() . " \n";
            $sSqlExplain.= 'AND `' . $oDTDBWhere->get_sKey() . '` ' . $oDTDBWhere->get_sRelation() . ' ' . "'" . $oDTDBWhere->get_sValue() . "',";
        }

        $sSql = substr($sSql, 0,-1) . "\n";
        $sSqlExplain = substr($sSqlExplain, 0,-1) . "\n";

        /** @var \MVC\DataType\DTDBOption $oDTDBOption */
        foreach ($aDTDBOption as $oDTDBOption)
        {
            $sSql.= "\n" . $oDTDBOption->get_sValue() . " \n";
            $sSqlExplain.= "\n" . $oDTDBOption->get_sValue() . " \n";
        }

        $oSql = new ArrDot();
        $oSql->set('sSql', str_replace("\n", ' ', stripslashes($sSqlExplain)));
        Event::run('mvc.db.model.db.retrieve.sql', $oSql);

        $oStmt = $this->oDbPDO->prepare($sSql);

        /** @var \MVC\DataType\DTDBWhere $oDTDBWhere */
        foreach ($aDTDBWhere as $oDTDBWhere)
        {
            $iPdoParam = 0;
            ('integer' === gettype($oDTDBWhere->get_sValue())) ? $iPdoParam = \PDO::PARAM_INT : false;
            ('string' === gettype($oDTDBWhere->get_sValue())) ? $iPdoParam = \PDO::PARAM_STR : false;
            ('object' === gettype($oDTDBWhere->get_sValue())) ? $iPdoParam = \PDO::PARAM_STR: false;
            ('boolean' === gettype($oDTDBWhere->get_sValue())) ? $iPdoParam = \PDO::PARAM_BOOL : false;
            ('null' === gettype($oDTDBWhere->get_sValue())) ? $iPdoParam = \PDO::PARAM_NULL : false;

            $oStmt->bindValue(
                ':' . $oDTDBWhere->get_sKey(),
                $oDTDBWhere->get_sValue(),
                $iPdoParam
            );
        }

        try
        {
            $oStmt->execute();
            $aFetchAll = $oStmt->fetchAll(\PDO::FETCH_ASSOC);
        }
        catch (\Exception $oException)
        {
            Error::exception($oException);
        }

        $sDataTypeClass = strtok(get_class($this), '\\') . '\\DataType\\' . $this->getGenerateDataTypeClassName();

        $aObject = array_map(
            function($aData) use ($sDataTypeClass){
                return $sDataTypeClass::create($aData);
            },
            $aFetchAll
        );

        $oDTValue = DTValue::create()->set_mValue($aObject);
        Event::run('mvc.db.model.db.retrieve.after', $oDTValue);
        $aObject = $oDTValue->get_mValue();

        return $aObject;
    }

    /**
     * @param \MVC\DataType\DTDBWhere[] $aDTDBWhere
     * @return int
     * @throws \ReflectionException
     */
    public function count(array $aDTDBWhere = array()) : int
    {
        $oDTValue = DTValue::create()->set_mValue($aDTDBWhere);
        Event::run('mvc.db.model.db.count.before', $oDTValue);
        $aDTDBWhere = $oDTValue->get_mValue();

        $sSql = "SELECT COUNT(id) AS iAmount FROM `" . $this->sTableName . "` \nWHERE  1\n";
        $sSqlExplain = $sSql;

        /** @var \MVC\DataType\DTDBWhere $oDTDBWhere */
        foreach ($aDTDBWhere as $oDTDBWhere)
        {
            $sSql.= 'AND `' . $oDTDBWhere->get_sKey() . '` ' . $oDTDBWhere->get_sRelation() . ' :' . $oDTDBWhere->get_sKey() . " \n";
            $sSqlExplain.= '`' . $oDTDBWhere->get_sKey() . '` = ' . "'" . $oDTDBWhere->get_sValue() . "',";
        }

        $oSql = new ArrDot();
        $oSql->set('sSql', str_replace("\n", ' ', stripslashes($sSqlExplain)));
        Event::run('mvc.db.model.db.count.sql', $oSql);

        $oStmt = $this->oDbPDO->prepare($sSql);

        /** @var \MVC\DataType\DTDBWhere $oDTDBWhere */
        foreach ($aDTDBWhere as $oDTDBWhere)
        {
            $iPdoParam = 0;
            ('integer' === gettype($oDTDBWhere->get_sValue())) ? $iPdoParam = \PDO::PARAM_INT : false;
            ('string' === gettype($oDTDBWhere->get_sValue())) ? $iPdoParam = \PDO::PARAM_STR : false;
            ('object' === gettype($oDTDBWhere->get_sValue())) ? $iPdoParam = \PDO::PARAM_STR: false;
            ('boolean' === gettype($oDTDBWhere->get_sValue())) ? $iPdoParam = \PDO::PARAM_BOOL : false;
            ('null' === gettype($oDTDBWhere->get_sValue())) ? $iPdoParam = \PDO::PARAM_NULL : false;

            $oStmt->bindValue(
                ':' . $oDTDBWhere->get_sKey(),
                $oDTDBWhere->get_sValue(),
                $iPdoParam
            );
        }

        try
        {
            $oStmt->execute();
            $aFetchAll = $oStmt->fetchAll(\PDO::FETCH_ASSOC);
            $iAmount = (int) current($aFetchAll)['iAmount'];
        }
        catch (\Exception $oException)
        {
            Error::exception($oException);

            return 0;
        }

        return $iAmount;
    }

    /**
     * @param \MVC\DataType\DTDBSet[] $aDTKeyValue
     * @param \MVC\DataType\DTDBWhere[] $aDTDBWhere
     * @return bool
     * @throws \ReflectionException
     */
    public function update(array $aDTDBSet = array(), array $aDTDBWhere = array()) : bool
    {
        if (true === empty($aDTDBSet) || true === empty($aDTDBWhere))
        {
            return false;
        }

        #---

        $oDTValue = DTValue::create()->set_mValue(array('aDTDBSet' => $aDTDBSet, 'aDTDBWhere' => $aDTDBWhere));
        Event::run('mvc.db.model.db.update.before', $oDTValue);
        /** @var \MVC\DataType\DTDBSet[] $aDTDBSet */
        $aDTDBSet = $oDTValue->get_mValue()['aDTDBSet'];
        /** @var \MVC\DataType\DTDBWhere[] $aDTDBWhere */
        $aDTDBWhere = $oDTValue->get_mValue()['aDTDBWhere'];

        #---

        $sSql = "UPDATE `" . $this->sTableName . "` SET \n";
        $sSqlExplain =  $sSql;

        /** @var \MVC\DataType\DTDBSet $oDTDBSet */
        foreach ($aDTDBSet as $oDTDBSet)
        {
            $sSql.= '`' . $oDTDBSet->get_sKey() . '` = :' . $oDTDBSet->get_sKey() . ",";
            $sSqlExplain.= '`' . $oDTDBSet->get_sKey() . '` = ' . "'" . $oDTDBSet->get_sValue() . "',";
        }

        $sSql = substr($sSql, 0,-1) . "\n";
        $sSqlExplain = substr($sSqlExplain, 0,-1) . "\n";
        $sWhere = "WHERE 1\n";

        /** @var \MVC\DataType\DTDBWhere $oDTDBWhere */
        foreach ($aDTDBWhere as $oDTDBWhere)
        {
            $sWhere.= 'AND `' . $oDTDBWhere->get_sKey() . '` ' . $oDTDBWhere->get_sRelation() . ' ' . "'" . $oDTDBWhere->get_sValue() . "' \n";
        }

        $sSql.= $sWhere;
        $sSqlExplain.= $sWhere;

        #---

        $oSql = new ArrDot();
        $oSql->set('sSql', str_replace("\n", ' ', stripslashes($sSqlExplain)));
        Event::run('mvc.db.model.db.update.sql', $oSql);

        #---

        $oStmt = $this->oDbPDO->prepare($sSql);

        /** @var \MVC\DataType\DTDBSet $oDTDBSet */
        foreach ($aDTDBSet as $oDTDBSet)
        {
            $iPdoParam = 0;
            ('integer' === gettype($oDTDBSet->get_sValue())) ? $iPdoParam = \PDO::PARAM_INT : false;
            ('string' === gettype($oDTDBSet->get_sValue())) ? $iPdoParam = \PDO::PARAM_STR : false;
            ('object' === gettype($oDTDBSet->get_sValue())) ? $iPdoParam = \PDO::PARAM_STR: false;
            ('boolean' === gettype($oDTDBSet->get_sValue())) ? $iPdoParam = \PDO::PARAM_BOOL : false;
            ('null' === gettype($oDTDBSet->get_sValue())) ? $iPdoParam = \PDO::PARAM_NULL : false;

            $oStmt->bindValue(
                ':' . $oDTDBSet->get_sKey(),
                $oDTDBSet->get_sValue(),
                $iPdoParam
            );
        }

        try
        {
            $oStmt->execute();
        }
        catch (\Exception $oException)
        {
            \MVC\Error::exception($oException);
            return false;
        }

        return true;
    }

    /**
     * updates a single, concrete dataset (a tupel) identified by id
     * @param \MVC\DB\DataType\DB\TableDataType $oTableDataType
     * @return bool
     * @throws \ReflectionException
     */
    public function updateTupel(TableDataType $oTableDataType) : bool
    {
        Event::run('mvc.db.model.db.updateTupel.before', $oTableDataType);

        $aDTDBSet = array();
        $aDTDBWhere = array();

        foreach ($oTableDataType->getPropertyArray() as $sKey => $sValue)
        {
            $aDTDBSet[] = DTDBSet::create()->set_sKey($sKey)->set_sValue($sValue);
        }

        $aDTDBWhere[] = DTDBWhere::create()
            ->set_sKey(TableDataType::getPropertyName_id())
            ->set_sRelation('=')
            ->set_sValue($oTableDataType->get_id());

        $bUpdate = $this->update(
            $aDTDBSet,
            $aDTDBWhere
        );

        return $bUpdate;
    }

    /**
     * @param \MVC\DB\DataType\DB\TableDataType $oTableDataType
     * @return bool
     * @throws \ReflectionException
     */
    public function deleteTupel(TableDataType $oTableDataType) : bool
    {
        Event::run('mvc.db.model.db.deleteTupel.before', $oTableDataType);

        if (0 === $oTableDataType->get_id())
        {
            return false;
        }

        $aDTDBWhere = array(
            DTDBWhere::create()
                ->set_sKey($oTableDataType::getPropertyName_id())
                ->set_sValue($oTableDataType->get_id()),
        );

        $bDelete = $this->delete($aDTDBWhere);

        return $bDelete;
    }

    /**
     * @param string $sSql
     * @return array|mixed
     */
    public function fetchRow(string $sSql = '') : mixed
    {
        if (true === empty($sSql))
        {
            return array();
        }

        $aResult = $this->oDbPDO->fetchRow($sSql);

        return $aResult;
    }

    /**
     * @param string $sSql
     * @return array
     */
    public function fetchAll(string $sSql = '') : array
    {
        if (true === empty($sSql))
        {
            return array();
        }

        $aResult = $this->oDbPDO->fetchAll($sSql);

        return $aResult;
    }

    /**
     * @param DTDBWhere[] $aDTDBWhere
     * @return bool
     * @throws \ReflectionException
     */
    public function delete(array $aDTDBWhere = array()) : bool
    {
        if (true === empty($aDTDBWhere))
        {
            return false;
        }

        $oDTValue = DTValue::create()->set_mValue($aDTDBWhere);
        Event::run('mvc.db.model.db.delete.before', $oDTValue);
        $aDTDBWhere = $oDTValue->get_mValue();

        $bDelete = false;
        $sSql = "DELETE FROM `" . $this->sTableName . "` WHERE 1\n";
        $sSqlExplain = $sSql;

        /** @var \MVC\DataType\DTDBWhere $oDTDBWhere */
        foreach ($aDTDBWhere as $oDTDBWhere)
        {
            $sSql.= 'AND `' . $oDTDBWhere->get_sKey() . '` ' . $oDTDBWhere->get_sRelation() . ' :' . $oDTDBWhere->get_sKey() . " \n";
            $sSqlExplain.= '`' . $oDTDBWhere->get_sKey() . '` = ' . "'" . $oDTDBWhere->get_sValue() . "',";
        }

        $oSql = new ArrDot();
        $oSql->set('sSql', str_replace("\n", ' ', stripslashes($sSqlExplain)));
        Event::run('mvc.db.model.db.delete.sql', $oSql);

        $oStmt = $this->oDbPDO->prepare($sSql);

        /** @var \MVC\DataType\DTDBWhere $oDTDBWhere */
        foreach ($aDTDBWhere as $oDTDBWhere)
        {
            $iPdoParam = 0;
            ('integer' === gettype($oDTDBWhere->get_sValue())) ? $iPdoParam = \PDO::PARAM_INT : false;
            ('string' === gettype($oDTDBWhere->get_sValue())) ? $iPdoParam = \PDO::PARAM_STR : false;
            ('object' === gettype($oDTDBWhere->get_sValue())) ? $iPdoParam = \PDO::PARAM_STR: false;
            ('boolean' === gettype($oDTDBWhere->get_sValue())) ? $iPdoParam = \PDO::PARAM_BOOL : false;
            ('null' === gettype($oDTDBWhere->get_sValue())) ? $iPdoParam = \PDO::PARAM_NULL : false;

            $oStmt->bindValue(
                ':' . $oDTDBWhere->get_sKey(),
                $oDTDBWhere->get_sValue(),
                $iPdoParam
            );
        }

        try
        {
            $bDelete = $oStmt->execute();
        }
        catch (\Exception $oExc)
        {
            Error::exception($oExc);

            return false;
        }

        return $bDelete;
    }

    /**
     * @param int    $iId
     * @param string $sFieldName
     * @return mixed
     * @throws \ReflectionException
     */
    public function getOnId(int $iId = 0, string $sFieldName = '') : mixed
    {
        $oTableDataType = $this->retrieveTupel(TableDataType::create()->set_id($iId));

        if ('' !== $sFieldName)
        {
            $aTableDataType = $oTableDataType->getPropertyArray();

            return get($aTableDataType[$sFieldName]);
        }

        return $oTableDataType;
    }

    /**
     * auto delete caches
     * @throws \ReflectionException
     */
    public function __destruct()
    {
        // sync Table Fields according to $aFields
        $this->synchronizeFields();

        // creating a DataType Class according to the table
        $this->generateDataType();

        // delete caches explicitely related to the referenced table
        Cache::autoDeleteCache($this->sCacheKeyTableName);
    }
}
