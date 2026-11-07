<?php
/**
 * Xml.php
 *
 * @package Emvicy
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <emvicy@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

namespace MVC;


use function Foo\Controller\xml2array;

class Xml
{
    /**
     * @param string $sString
     * @return bool valid
     * @throws \ReflectionException
     */
    public static function isValid(string $sString = ''): bool
    {
        libxml_use_internal_errors(use_errors: true);
        $oSimpleXMLElement = simplexml_load_string($sString);

        if ($oSimpleXMLElement === false)
        {
            libxml_clear_errors();
            Error::notice('String is not valid XML: ' . Strings::cutOff(sString: Strings::tidy($sString), iLimit: 10));

            return false;
        }

        return true;
    }

    /**
     * @param string $sXml
     * @return array
     * @throws \ReflectionException
     */
    public static function toArray(string $sXml = ''): array
    {
        if (true === self::isValid($sXml))
        {
            $oSimpleXmlElement = simplexml_load_string($sXml);

            if ($oSimpleXmlElement instanceof \SimpleXMLElement)
            {
                return self::decode($oSimpleXmlElement);
            }
        }

        return array();
    }

    /**
     * @credits taken from https://stackoverflow.com/a/72917254,
     *          author https://stackoverflow.com/users/14051509/covaleski
     *          (slightly refactored by https://github.com/gueff)
     * @param \SimpleXMLElement $oSimpleXMLElement
     * @param bool              $bAttrKey
     * @param bool              $bReduce
     * @param array             $aAlways
     * @param array             $aValueKey
     * @return string|array
     */
    protected static function decode(\SimpleXMLElement $oSimpleXMLElement, bool $bAttrKey = true, bool $bReduce = true, array $aAlways = array(), array $aValueKey = array()): string|array
    {
        $aXml = array();
        $sXmlName = $oSimpleXMLElement->getName();

        foreach ($oSimpleXMLElement->attributes() as $sKey => $sValue)
        {
            if (true === $bAttrKey)
            {
                $aXml['attributes'][strval($sKey)] = strval($sValue);
            }
            else
            {
                $aXml[strval($sKey)] = strval($sValue);
            }
        }

        $iChildCount = $oSimpleXMLElement->children()->count();

        if ($iChildCount == 0)
        {
            if (count($aXml) > 0)
            {
                $sKey = $aValueKey[$sXmlName] ?? $aValueKey['*'] ?? "value";
                $aXml[$sKey] = strval($oSimpleXMLElement);
            }
            else
            {
                $aXml = strval($oSimpleXMLElement);
            }
        }
        else
        {
            $aChildName = array();

            foreach ($oSimpleXMLElement->children() as $oChild)
            {
                in_array($oChild->getName(), $aChildName) or $aChildName[] = $oChild->getName();
            }

            $bReducible = (empty($aXml) && count($aChildName) === 1);

            foreach ($oSimpleXMLElement->children() as $oChild)
            {
                $sName = $oChild->getName();

                if ($oSimpleXMLElement->$sName->count() > 1 || in_array($sName, $aAlways))
                {
                    if (true === $bReduce && true === $bReducible)
                    {
                        $aXml[] = self::decode($oChild, $bAttrKey, $bReduce, $aAlways, $aValueKey);
                    }
                    else
                    {
                        $aXml[$sName][] = self::decode($oChild, $bAttrKey, $bReduce, $aAlways, $aValueKey);
                    }
                }
                else
                {
                    $aXml[$sName] = self::decode($oChild, $bAttrKey, $bReduce, $aAlways, $aValueKey);
                }
            }
        }

        return $aXml;
    }
}