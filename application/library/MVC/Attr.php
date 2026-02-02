<?php

namespace MVC;

use function Sodium\library_version_minor;

/**
 * @experimental
 */
class Attr
{
    /**
     * @see https://www.php.net/manual/de/language.attributes.reflection.php
     * @example Attr::getData( new ReflectionClass(MyClass::class) )
     * @param \Reflector  $oReflectionObject
     * @param string|null $sClassName
     * @param int|null    $iFlag
     * @param string|null $sScope
     * @return array|false|mixed
     */
    public static function getData(\Reflector $oReflectionObject, ?string $sClassName = null, ?int $iFlag = null, ?string $sScope = '')
    {
        $aReflectionAttribute = $oReflectionObject->getAttributes($sClassName, $iFlag);
        $aResult = array();

        /** @var \ReflectionAttribute $oReflectionAttribute */
        foreach ($aReflectionAttribute as $oReflectionAttribute)
        {
            $aTmp = array();
            (true === empty($sScope)) ? $aTmp['name'] = $oReflectionAttribute->getName() : false;
            ('name' === $sScope) ? $aTmp = $oReflectionAttribute->getName() : false;

            (true === empty($sScope)) ? $aTmp['argument'] = $oReflectionAttribute->getArguments() : false;
            ('argument' === $sScope) ? $aTmp = $oReflectionAttribute->getArguments() : false;

            (true === empty($sScope)) ? $aTmp['instance'] = ((true === class_exists($oReflectionAttribute->getName(), false)) ? $oReflectionAttribute->newInstance() : null) : false;
            ('instance' === $sScope) ? $aTmp = ((true === class_exists($oReflectionAttribute->getName(), false)) ? $oReflectionAttribute->newInstance() : null) : false;

            (true === empty($sScope)) ? $aResult[$oReflectionAttribute->getName()] = $aTmp : $aResult[] = $aTmp;
        }

        if (false === empty($sClassName))
        {
            /** @var get_class($oReflectionAttribute->newInstance()) $oInstance */
            $oInstance = current($aResult);

            return $oInstance;
        }

        /** @var array $aResult */
        return $aResult;
    }

    /**
     * @param string $sClassName
     * @return array|\ReflectionAttribute[]
     * @throws \ReflectionException
     */
    public static function getOnClass(string $sClassName = '')
    {
        if (true === empty($sClassName))
        {
            $sClassName = debug_backtrace(limit: 2)[1]['class'];
        }

        if (true === empty($sClassName))
        {
            return array();
        }

        return new \ReflectionClass($sClassName)->getAttributes();
    }

    /**
     * @param string|null $sAttributeName
     * @param string      $sMethodName
     * @return array|\ReflectionAttribute[]
     * @throws \ReflectionException
     */
    public static function getOnMethod(?string $sAttributeName = null, string $sMethodName = '')
    {
        if (true === empty($sMethodName))
        {
            $oClassObject = (debug_backtrace(limit: 2)[1]['object'] ?? null);
            $sMethodName = (debug_backtrace(limit: 2)[1]['function'] ?? '');
        }

        if (true === empty($oClassObject) || true === empty($sMethodName))
        {
            return array();
        }

        return new \ReflectionMethod($oClassObject, $sMethodName)->getAttributes($sAttributeName);
    }
}