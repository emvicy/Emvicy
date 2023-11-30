<?php
/**
 * Controller.php
 *
 * @package Emvicy
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <emvicy@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

namespace App;

use MVC\Config;
use MVC\DataType\DTRequestCurrent;
use MVC\DataType\DTRoute;

/**
 * Controller
 */
class Controller implements \MVC\MVCInterface\Controller
{
    /**
     * @return void
     */
    public static function __preconstruct()
    {
        ;
    }

    /**
     * @param \MVC\DataType\DTRequestCurrent $oDTRequestCurrent
     * @param \MVC\DataType\DTRoute          $oDTRoute
     * @throws \ReflectionException
     */
    public function __construct(DTRequestCurrent $oDTRequestCurrent, DTRoute $oDTRoute)
    {
        // get .version of Emvicy Framework
        mvcStoreEnv(realpath(Config::get_MVC_APPLICATION_PATH() . '/../') . '/.version');

        // get .version of Emvicy Modules if available
        foreach (glob(Config::get_MVC_MODULES_DIR() . '/*', GLOB_ONLYDIR) as $sModuleAbs)
        {
            $sVersionAbs = $sModuleAbs . '/.version';
            (true === file_exists($sVersionAbs))
                ? mvcStoreEnv($sVersionAbs)
                : false
            ;
        }
    }

    /**
     * checks module on primary status
     * @return bool module is primary
     * @throws \ReflectionException
     */
    protected function isPrimary()
    {
        return ((strtok(get_class($this), '\\')) === Config::get_MVC_MODULE_PRIMARY_NAME());
    }

    /**
     *
     */
    public function __destruct()
    {
        ;
    }
}
