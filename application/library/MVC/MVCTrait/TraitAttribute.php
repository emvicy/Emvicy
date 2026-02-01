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

/**
 * @experimental
 */
#[experimental]
trait TraitAttribute
{
    /**
     * @param string|null $sClassName
     * @param int|null    $iFlag
     * @param string|null $sScope
     * @return array|false|mixed|string
     * @throws \ReflectionException
     */
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

    /**
     * @param string      $sAttribute
     * @param string|null $sClassName
     * @param int|null    $iFlag
     * @param string|null $sScope
     * @return array|false|mixed|string
     * @throws \ReflectionException
     */
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

    /**
     * @param string|null $sMethod
     * @param string|null $sClassName
     * @param int|null    $iFlag
     * @param string|null $sScope
     * @return array|false|mixed|string
     * @throws \ReflectionException
     */
    public function trait_getAttributeMethod(?string $sMethod = '', ?string $sClassName = null, ?int $iFlag = null, ?string $sScope = '')
    {
        (true === empty($sMethod)) ? $sMethod = (debug_backtrace(limit: 2)[1]['function'] ?? '') : false;

        if (true === empty($sMethod))
        {
            return false;
        }

        try {
            $oReflectionProperty = new \ReflectionMethod($this::class, $sMethod);
        } catch (\ReflectionException $oReflectionException) {
            Error::exception($oReflectionException);
            return $oReflectionException->getMessage();
        }

        return Attr::getData($oReflectionProperty, $sClassName, $iFlag, $sScope);
    }
}