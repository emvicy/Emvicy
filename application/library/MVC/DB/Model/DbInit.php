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

use MVC\Config;
use MVC\Debug;
use MVC\Error;
use MVC\Event;
use MVC\MVCTrait\TraitDataType;

class DbInit
{
    use TraitDataType;

    /**
     * @var null
     */
    protected static $_oInstance = null;

    /**
     * @var \MVC\DB\Model\DbPDO
     */
    public static $oPDO;

    /**
     * Constructor
     * @param array $aConfig
     * @throws \ReflectionException
     */
    protected function __construct(array $aConfig = array())
    {
        // try default fallback config; assuming it is called 'DB'
        (true === empty($aConfig)) ? $aConfig = self::getConfig() : false;

        \Cachix::init(Config::get_MVC_CACHE_CONFIG());
        $aClassVar = get_class_vars(get_class($this));

        try {
            $oDbPDO = new DbPDO($aConfig);
        } catch (\PDOException $oPDOException) {
            Error::exception($oPDOException);
            return false;
        }

        self::$oPDO = $oDbPDO;

        foreach ($aClassVar as $sProperty => $mFoo)
        {
            // skip
            if ('_oInstance' === $sProperty)
            {
                continue;
            }

            $sClass = $this->getDocCommentValueOfProperty($sProperty);
            $oReflectionClass = new \ReflectionClass(get_class($this));
            $oReflectionClass->setStaticPropertyValue(
                $sProperty,
                new $sClass($aConfig)
            );
        }

        Event::run('mvc.db.model.dbinit.construct.after');
    }

    /**
     * @param string $sModuleConfigKey
     * @return array
     * @throws \ReflectionException
     */
    protected static function getConfig(string $sModuleConfigKey = 'DB')
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
}