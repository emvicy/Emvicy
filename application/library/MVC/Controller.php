<?php
/**
 * Controller.php
 *
 * @package Emvicy
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <emvicy@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

namespace MVC;

use MVC\DataType\DTArrayObject;
use MVC\DataType\DTKeyValue;
use MVC\MVCTrait\TraitAttribute;

/**
 * Controller
 */
class Controller
{
    /**
     * calls the "__preconstruct()" method
     * at the requested Controller
     * @return void
     * @throws \ReflectionException
     */
    public static function runTargetClassPreconstruct () : void
    {
        // may be false
        $oDTRoute = Route::getCurrent();
        $sTargetClass = $oDTRoute->get_class();
        $sTargetClassFile = $oDTRoute->get_classFile();
        $sMethodNamePreconstruct = Config::get_MVC_METHODNAME_PRECONSTRUCT();

        info(
            Attr::getData(new \ReflectionClass($sTargetClass))
        );

        if (false === file_exists ($sTargetClassFile))
        {
            $sMessage = "\n"
                        . "Classfile missing: " . $sTargetClassFile . "\n"
                        . "Abort.\n\n"
                        . str_repeat('-', 80) . "\n\n"
                        . "Documentation\nhttps://emvicy.com/\n\n"
            ;

            if (false === Config::get_MVC_CLI())
            {
                $sMessage = nl2br($sMessage);
            }

            echo $sMessage;
            Error::error(trim($sMessage));
            die();
        }

        if (class_exists ($sTargetClass))
        {
            if (method_exists ($sTargetClass, $sMethodNamePreconstruct))
            {
                $sTargetClass::$sMethodNamePreconstruct();
            }
        }
        else
        {
            Event::run('mvc.error',
                DTArrayObject::create()
                    ->add_aKeyValue(
                        DTKeyValue::create()->set_sKey('iLevel')->set_sValue(1)
                    )
                    ->add_aKeyValue(
                        DTKeyValue::create()->set_sKey('sMessage')->set_sValue(__FILE__ . ', ' . __LINE__ . "\t" . 'Class does not exist: `' . $sTargetClass . '`')
                    )
            );
        }

        Event::run('mvc.controller.runTargetClassPreconstruct.after',
            DTArrayObject::create()
                ->add_aKeyValue(
                    DTKeyValue::create()->set_sKey('sClass')->set_sValue($sTargetClass)
                )
                ->add_aKeyValue(
                    DTKeyValue::create()->set_sKey('sMethod')->set_sValue($sMethodNamePreconstruct)
                )
        );
    }

    /**
     * Controller constructor.
     * @return bool
     * @throws \ReflectionException
     */
    public static function init() : bool
    {
        Event::run('mvc.controller.init.before');

        // start requested Module/Class/Method
        $oReflex = new Reflex();
        $bSuccess = $oReflex->reflect ();

        Event::run('mvc.controller.init.after', $bSuccess);

        return $bSuccess;
    }

    /**
     * @throws \ReflectionException
     */
	public function __destruct ()
	{
        Event::run('mvc.controller.destruct.before',
            DTArrayObject::create()
                ->add_aKeyValue(
                    DTKeyValue::create()->set_sKey('oController')->set_sValue($this)
                )
        );
	}
}