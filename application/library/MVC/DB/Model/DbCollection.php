<?php
/**
 * DbInit.php
 *
 * @package Emvicy
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <emvicy@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

namespace MVC\DB\Model;

use MVC\Cache;
use MVC\Config;
use MVC\Debug;
use MVC\Error;
use MVC\Event;
use MVC\MVCTrait\TraitDataType;
use MVC\Registry;

class DbCollection
{
    use TraitDataType;

    /**
     * @var null
     */
    protected static $_oInstance = null;

    /**
     * @var mixed|\MVC\DB\Model\DbPDO|null
     */
    public $oDbPDO = null;

    /**
     * Constructor
     * @param array $aConfig
     * @throws \ReflectionException
     */
    protected function __construct(array $aConfig = array())
    {
        // try default fallback config; assuming it is called 'DB'
        (true === empty($aConfig)) ? $aConfig = self::getConfig() : false;

        Cache::init(Config::get_MVC_CACHE_CONFIG());
        (Registry::isRegistered(Db::$sRegistryKeyDbPDO)) ? $this->oDbPDO = Registry::get(Db::$sRegistryKeyDbPDO) : false;

        if (null === $this->oDbPDO)
        {
            try
            {
                $this->oDbPDO = new DbPDO($aConfig);
                /** @todo getter/setter für Registry based on aConfig */
                Registry::set(Db::$sRegistryKeyDbPDO, $this->oDbPDO);
            } catch (\PDOException $oPDOException)
            {
                Error::exception($oPDOException);

                return;
            }
        }

        Event::run('mvc.db.model.dbcollection.construct.after', Registry::get(Db::$sRegistryKeyDbPDO));
    }

    /**
     * @param string $sModuleConfigKey
     * @return array
     * @throws \ReflectionException
     */
    public static function getConfig(string $sModuleConfigKey = 'DB')
    {
        // try default fallback config; assuming it is called 'DB'
        // DB config key
        $aConfig = Config::MODULE()[$sModuleConfigKey];

        // no DB module config found
        if (true === empty($aConfig))
        {
            $sMessage = 'Module Config `' . $sModuleConfigKey . '` not found. Abort. - ' . error_reporting();
            Error::error($sMessage);
            Debug::stop(
                $sMessage,
                (0 === error_reporting() ? false : true), # suppress info on 0
                (0 === error_reporting() ? false : true)  # suppress info on 0
            );
        }

        return $aConfig;
    }

    /**
     * @param $sProperty
     * @return mixed
     * @throws \ReflectionException
     */
    protected function activate($sProperty)
    {
        $oReflectionProperty = new \ReflectionProperty($this, $sProperty);
        $sDocComment = $oReflectionProperty->getDocComment();
        $sClass = trim(str_replace(['*','/','@var'], '', current(array_filter(array_map(
            function($sLine){
                if (stristr($sLine, 'var')) {
                    return $sLine;
                }
            },
            array_map('trim', explode("\n", $sDocComment))
        )))));

        return $sClass::init(self::getConfig());
    }
}