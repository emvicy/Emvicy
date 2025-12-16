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

use MVC\_Init\MvcStoreEnv;
use MVC\Config;
use MVC\DataType\DTRequestIn;
use MVC\DataType\DTRoute;
use MVC\Event;
use MVC\MVCInterface\InterfaceController;

/**
 * Controller
 */
class Controller implements InterfaceController
{
    public static function __preconstruct()
    {
        ;
    }

    /**
     * @param \MVC\DataType\DTRequestIn $oDTRequestIn
     * @param \MVC\DataType\DTRoute     $oDTRoute
     * @throws \ReflectionException
     */
    public function __construct(DTRequestIn $oDTRequestIn, DTRoute $oDTRoute)
    {
        Event::run('app.controller.__construct.before', $oDTRequestIn);

        // get .version of Emvicy Framework
//        mvcStoreEnv(realpath(Config::get_MVC_APPLICATION_PATH() . '/../') . '/.version');
        MvcStoreEnv::do(realpath(Config::get_MVC_APPLICATION_PATH() . '/../') . '/.version');

        // get .version of Emvicy Modules if available
        foreach (glob(Config::get_MVC_MODULES_DIR() . '/*', GLOB_ONLYDIR) as $sModuleAbs)
        {
            $sVersionAbs = $sModuleAbs . '/.version';
            (true === file_exists($sVersionAbs))
                ? MvcStoreEnv::do($sVersionAbs) #mvcStoreEnv($sVersionAbs)
                : false
            ;
        }
    }

    /**
     * checks module on primary status
     * @return bool module is primary
     * @throws \ReflectionException
     */
    protected function isPrimary(): bool
    {
        return ((strtok(get_class($this), '\\')) === Config::get_MVC_MODULE_PRIMARY_NAME());
    }

    /**
     * @throws \ReflectionException
     */
    public function __destruct()
    {
        Event::run('app.controller.__destruct');
    }
}
