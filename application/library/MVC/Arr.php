<?php
/**
 * Arr.php
 *
 * @package Emvicy
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <emvicy@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */


namespace MVC;

class Arr
{
    /**
     * @example Arr::recursiveFind(Convert::objectToArray(Route::$aMethodRoute), 'get-404');
     *          returns [0 => 'GET', 1 => '/404/', 2 => 'tag']
     * @param array $aHaystack
     * @param       $sNeedle
     * @return array|int|string
     */
    public static function recursiveFind(array $aHaystack, $sNeedle): int|array|string
    {
        foreach ($aHaystack as $sFirstLevelKey => $mValue)
        {
            if ($sNeedle === $mValue)
            {
                return array($sFirstLevelKey);
            }
            elseif (is_array($mValue))
            {
                $oCallback = self::recursiveFind($mValue, $sNeedle);

                if ($oCallback)
                {
                    return array_merge(array($sFirstLevelKey), $oCallback);
                }
            }
        }

        return array();
    }

    /**
     * trims string values of an array recursively
     * @param mixed $mData
     * @return array|mixed|string
     */
    public static function recursiveTrim(mixed $mData)
    {
        return is_array($mData)
            ? array_map('\MVC\Arr::recursiveTrim', $mData)
            : (
            is_string($mData)
                ? trim($mData)
                : $mData
            );
    }
}