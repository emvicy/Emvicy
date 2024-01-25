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
    public static function recursiveFind(array $aHaystack, $sNeedle)
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
}