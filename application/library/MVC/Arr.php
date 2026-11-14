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

    /**
     * @deprecated use instead: Arr::changeKeyCase()
     * changes case keys in a multidimensional array
     * @param array $aData
     * @param       $iCase default=CASE_LOWER; use CASE_LOWER|CASE_UPPER;
     * @return array|array[]
     */
    public static function changeKeyCaseRecursively(array $aData = array(), $iCase = CASE_LOWER)
    {
        return self::changeKeyCase($aData, $iCase);
    }

    /**
     * changes case keys in a multidimensional array
     * @param array $aData
     * @param int   $iKeyCase default=CASE_LOWER; use CASE_LOWER|CASE_UPPER;
     * @return array|array[]
     */
    public static function changeKeyCase(array $aData = array(), int $iKeyCase = CASE_LOWER)
    {
        $iKeyCase = (abs($iKeyCase) >= CASE_UPPER) ? CASE_UPPER : CASE_LOWER;

        return array_map(
            function($mItem) use ($iKeyCase) {

                if (true === is_array($mItem))
                {
                    $mItem = self::changeKeyCase($mItem, $iKeyCase);
                }

                return $mItem;
            },
            array_change_key_case($aData, $iKeyCase)
        );
    }
}