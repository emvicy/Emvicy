<?php
/**
 * View.php
 *
 * @package Emvicy
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <emvicy@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

namespace App;

use MVC\Config;
use MVC\DataType\DTRoute;
use MVC\Route;

/**
 * Controller
 */
class View extends \MVC\View
{
    protected static $_oInstance;

    /**
     * Index constructor.
     * @throws \ReflectionException
     */
    protected function __construct()
	{
		parent::__construct ();
 	}

    /**
     * @return self
     */
    public static function init() : self
    {
        if (null === self::$_oInstance)
        {
            self::$_oInstance = new self();
        }

        Config::set_MVC_MODULE_PRIMARY_VIEW(self::$_oInstance);

        return self::$_oInstance;
    }

    /**
     * @param \MVC\DataType\DTRoute $oDTRoute
     * @return void
     * @throws \ReflectionException
     */
    public function autoAssign(?DTRoute $oDTRoute = null): void
    {
        (true === is_null($oDTRoute)) ? $oDTRoute = Route::getCurrent() : false;
        $oDTRoutingAdditional = $oDTRoute->get_additional();

        $this->sTemplateRelative = (false === empty($oDTRoutingAdditional->get_sTemplate()))
            ? $oDTRoutingAdditional->get_sTemplate()
            : Config::get_MVC_SMARTY_TEMPLATE_DEFAULT()
        ;
        $this->sTemplate = $this->sTemplateDir . '/' . $this->sTemplateRelative;

        // and this one will be rendered
        $this->assign('sTemplate', $this->sTemplate);
        $this->assign('oDTRoute', $oDTRoute);
        $this->assign('oDTRoutingAdditional', $oDTRoutingAdditional);
    }
}