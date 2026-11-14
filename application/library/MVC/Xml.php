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
     * converts an XML String in to an assoc array
     * @param string   $sXml
     * @param int|null $iKeyCase default=null (unchanged); use CASE_LOWER|CASE_UPPER
     * @return array
     */
    public static function toArray(string $sXml = '', ?int $iKeyCase = null): array
    {
        $oXml = simplexml_load_string(
            data: $sXml,
            class_name: "SimpleXMLElement",
            options: LIBXML_NOCDATA
        );
        $sJson = json_encode(value: $oXml);
        $sJson = str_replace(
            search: '"@attributes":',
            replace: '"attributes":',
            subject: $sJson
        );
        $aXml = json_decode(
            json: $sJson,
            associative: true
        );

        if (true === is_int($iKeyCase) && ($iKeyCase === 0 || $iKeyCase === 1))
        {
            $aXml = Arr::changeKeyCaseRecursively($aXml, $iKeyCase);
        }

        return $aXml;
    }

    /**
     * beautifies XML String
     * @param string $sXml
     * @return string
     * @throws \DOMException
     */
    public static function beautify(string $sXml)
    {
        $oDOMDocument = new \DOMDocument();
        $oDOMDocument->preserveWhiteSpace = false;
        $oDOMDocument->formatOutput = true;
        $oDOMDocument->loadXML(trim($sXml));

        return (string) $oDOMDocument->saveXml();
    }

    /**
     * replaces double colon `:` tags
     * (e.g. <soap:Header>..</soap:Header>)
     * and attributes (e.g. `<item xmlns:m="http://www.example.org/stock">..</item>`)
     * in an xml string
     * @param string $sXml the XML String
     * @param bool   $bLeaveDCPre default=false. true: leaves the part before ":" untouched; e.g. "<soap:" will not be replaced
     * @param string $sReplaceDCBy default=''
     * @return string
     * @throws \ReflectionException
     */
    public static function replaceDC(string $sXml = '', bool $bLeaveDCPre = false, string $sReplaceDCBy = '')
    {
        if (false === self::isValid($sXml))
        {
            return $sXml;
        }

        // leaves the part before ":" untouched; e.g. "<soap:" will not be replaced
        if (true === $bLeaveDCPre)
        {
            $sXml = preg_replace('~(</?|\s)([[:alnum:]]+):~isu', '$1$2' . $sReplaceDCBy, $sXml);
        }
        else
        {
            $sXml = preg_replace('~(</?|\s)([[:alnum:]]+):~isu', '$1' . $sReplaceDCBy, $sXml);
        }

        return (string) $sXml;
    }
}