<?php

namespace MVC\DB\Trait;

use MVC\DB\Model\DbInit;

trait DbInitTrait
{
    /**
     * for use in your concrete DBInit class
     * @param array $aConfig
     * @return \MVC\DB\Model\DbInit|null
     */
    public static function init(array $aConfig = array()) : DbInit|null
    {
        if (null === self::$_oInstance)
        {
            self::$_oInstance = new self($aConfig);
        }

        return self::$_oInstance;
    }
}
