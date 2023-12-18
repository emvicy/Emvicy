<?php

namespace MVC;

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
}