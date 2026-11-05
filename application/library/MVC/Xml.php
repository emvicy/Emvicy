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
                return json_decode(
                    json: json_encode($oSimpleXmlElement),
                    associative: true
                );
            }
        }

        return array();
    }

}