<?php
/**
 * TraitDataType.php
 * @package   Emvicy
 * @copyright ueffing.net
 * @author    Guido K.B.W. Üffing <emvicy@ueffing.net>
 * @license   GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

namespace MVC\MVCTrait;

use MVC\Attr;
use MVC\Error;

trait TraitAttribute
{
    public function trait_getAttributeClass(?string $sClassName = null, ?int $iFlag = null, ?string $sScope = '')
    {
        try {
            $oReflectionClass = new \ReflectionClass($this::class);
        } catch (\ReflectionException $oReflectionException) {
            Error::exception($oReflectionException);
            return $oReflectionException->getMessage();
        }

        return Attr::getData($oReflectionClass, $sClassName, $iFlag, $sScope);
    }

    public function trait_getAttributeProperty(string $sAttribute = '', ?string $sClassName = null, ?int $iFlag = null, ?string $sScope = '')
    {
        try {
            $oReflectionProperty = new \ReflectionProperty($this::class, $sAttribute);
        } catch (\ReflectionException $oReflectionException) {
            Error::exception($oReflectionException);
            return $oReflectionException->getMessage();
        }

        return Attr::getData($oReflectionProperty, $sClassName, $iFlag, $sScope);
    }

    public function trait_getAttributeMethod(?string $sMethod = '', ?string $sClassName = null, ?int $iFlag = null, ?string $sScope = '')
    {
        (true === empty($sMethod)) ? $sMethod = get(debug_backtrace()[1]['function'], '') : false;

        if (true === empty($sMethod))
        {
            return false;
        }

        echo 'method: <code>' . $sMethod . '</code><br>';

        try {
            $oReflectionProperty = new \ReflectionMethod($this::class, $sMethod);
        } catch (\ReflectionException $oReflectionException) {
            Error::exception($oReflectionException);
            return $oReflectionException->getMessage();
        }

        return Attr::getData($oReflectionProperty, $sClassName, $iFlag, $sScope);
    }
}