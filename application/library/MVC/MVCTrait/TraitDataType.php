<?php
/**
 * TraitDataType.php
 *
 * @package Emvicy
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <emvicy@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

namespace MVC\MVCTrait;

use MVC\DataType\DTValue;

trait TraitDataType
{
    /**
     * returns the value from a DocCommentKey (such as @param string $sProperty
     * @param string $sDocCommentKey
     * @param string $sProperty
     * @param string $sDocCommentKey
     * @param bool $bReturnArray | default=false
     * @return array|false|mixed|string
     * @throws \ReflectionException
     */
    function getDocCommentValueOfProperty(string $sProperty = '', string $sDocCommentKey = '@var', bool $bReturnArray = false)
    {
        // get array of properties
        $oReflectionClass = new \ReflectionClass($this);
        $aProperty = array_keys(get_class_vars($oReflectionClass->getName()));
        $bPropertyExists = in_array($sProperty, $aProperty);

        if (false === $bPropertyExists)
        {
            return '';
        }

        $oReflectionProperty = new \ReflectionProperty($this, $sProperty);
        $sDocComment = $oReflectionProperty->getDocComment();
        $aExplode = explode("\n", $sDocComment);

        // iterate DocComment lines
        foreach ($aExplode as $sLine)
        {
            // remove unwanted
            $sLine = str_replace('*', '', str_replace('/', '', $sLine));

            // key found
            if (stristr($sLine, $sDocCommentKey))
            {
                // remove unwanted
                $sLine = trim(str_replace('@', '', str_replace($sDocCommentKey, '', $sLine)));

                // if piped, explode
                if (strstr($sLine, '|'))
                {
                    $aLine = explode('|', $sLine);
                    $aLine = array_map('trim', $aLine);
                    $aLine = array_map('strtolower', $aLine);

                    if (true === $bReturnArray)
                    {
                        return $aLine;
                    }

                    // if there is null, take null...
                    if (true === in_array('null', $aLine))
                    {
                        return 'null';
                    }

                    // ...otherwise first type
                    return current($aLine);
                }

                // value left
                return $sLine;
            }
        }

        return '';
    }

    /**
     * @param \MVC\DataType\DTValue $oDTValue
     * @return \MVC\DataType\DTValue
     * @throws \ReflectionException
     */
    protected function setProperties(DTValue $oDTValue)
    {
        $aData = $oDTValue->get_mValue();

        if (false === is_array($aData))
        {
            return $oDTValue;
        }

        foreach ($aData as $sKey => $mValue)
        {
            // value should be type of
            $mType = $this->getDocCommentValueOfProperty($sKey, bReturnArray: true);
            $sType = $mType;

            if (true === is_array($mType))
            {
                (true === empty($mValue))
                    ? $sType = end($mType) # null
                    : $sType = current($mType);   # concrete type
            }

            $sVar = $aData[$sKey]; settype($sVar, $sType); $aData[$sKey] = $sVar;

            // if it can be null, set it to null
            if ('null' === $sType && true === empty($mValue))
            {
                $aSetTmp['value'] = 'null';
            }
            // value types
            elseif ('string' === $sType)
            {
                $aData[$sKey] = (string) $aData[$sKey];
            }
            elseif ('int' === $sType || 'integer' === $sType)
            {
                $aData[$sKey] = (int) $aData[$sKey];
            }
            elseif ('bool' === $sType || 'boolean' === $sType)
            {
                $aData[$sKey] = (boolean) $aData[$sKey];
            }
            elseif ('float' === $sType)
            {
                $aData[$sKey] = (float) $aData[$sKey];
            }
            elseif ('double' === $sType)
            {
                $aData[$sKey] = (float) $aData[$sKey];
            }
            elseif ('array' === $sType)
            {
                $aData[$sKey] = (array) $aData[$sKey];
            }

            $sMethod = 'set_' . $sKey;
            $this->$sMethod($aData[$sKey]);
        }

        $oDTValue->set_mValue($aData);

        return $oDTValue;
    }
}