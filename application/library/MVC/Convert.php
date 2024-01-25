<?php
/**
 * Convert.php
 *
 * @package Emvicy
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <emvicy@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

namespace MVC;

class Convert
{
    /**
     * converts an object into array
     * @param mixed $mObject
     * @param string $sPregReplace default=allow all
     * @return mixed
     */
    public static function objectToArray(mixed $mObject, string $sPregReplace = "/[^\\p{L}\\p{M}\\p{Z}\\p{S}\\p{N}\\p{P}\\p{C}]+/u") : mixed
    {
        if (true === is_object($mObject))
        {
            $mObject = (array) $mObject;
        }

        if (is_array($mObject))
        {
            $aNew = array();

            foreach ($mObject as $sKey => $mValue)
            {
                $sKey = preg_replace($sPregReplace, '', $sKey);

                if ((str_starts_with(trim($sKey), '*')) && (strlen($sKey) > 1))
                {
                    $sKey = trim(substr(trim($sKey), 1));
                }

                $aNew[$sKey] = self::objectToArray($mValue, $sPregReplace);
            }
        }
        else
        {
            $aNew = $mObject;
        }

        return $aNew;
    }

    /**
     * gets constant name on its integer value
     * @example $sLevel = Convert::const_value_to_key(1024); # E_USER_NOTICE
     * @param int   $iValue
     * @param array $aConstant | default: get_defined_constants()
     * @return string
     */
    public static function constValueToKey(int $iValue, array $aConstant = array()) : string
    {
        return trim((string) array_search(
            $iValue,
            ((true === empty($aConstant)) ? get_defined_constants() : $aConstant),
            true
        ));
    }

    /**
     * returns string on bool
     * @param bool $bValue
     * @return string
     */
    public static function boolToString(bool $bValue) : string
    {
        return (true === $bValue) ? 'true' : 'false';
    }
}