<?php
/**
 * Date.php
 *
 * @package Emvicy
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <emvicy@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3.
 */

namespace MVC;

use DateTime;
use MVC\DataType\DTDateWeekInfo;

class Date
{
    /**
     * checks if a requested value equals to the requested date format
     * @example var_dump(MVC\Date::validateDate('2022-10-09', 'Y-m-d')); # true
     * @credits https://www.php.net/manual/en/function.checkdate.php#113205
     * @param string  $sValue
     * @param string $sFormat default='Y-m-d H:i:s'
     * @return bool
     */
    public static function validateDate(string $sValue, string $sFormat = 'Y-m-d H:i:s') : bool
    {
        $oDateTime = DateTime::createFromFormat($sFormat, $sValue);
        return $oDateTime && $oDateTime->format($sFormat) == $sValue;
    }

    /**
     * gives the week number of the requested simplified ISO Date (Y-m-d)
     * @param string $sDateIso | empty=current day
     * @return int week number (KW)
     * @throws \Exception
     */
    public static function getWeekNumberOnIsoDate(string $sDateIso = '') : int
    {
        if ('' === $sDateIso)
        {
            $sDateIso = date('Y-m-d');
        }

        $oDateTime = new DateTime($sDateIso);

        return (int) $oDateTime->format("W");
    }

    /**
     * gives the amount of week numbers of the requested year (YYYY)
     * @param int $iYear
     * @return int amount week numbers
     */
    public static function getAmountOfWeekNumbersOfYear(int $iYear = 0) : int
    {
        $iYear = (0 === $iYear) ? date('Y') : $iYear;

        return (int) idate('W', mktime(0, 0, 0, 12, 28, $iYear));
    }

    /**
     * checks if a simplified ISO-date (Y-m-d) lays in between two other simplified ISO-Dates (Y-m-d)
     * @param string $sDateIsoRangeStart
     * @param string $sDateIsoRangeEnd
     * @param string $sDateIso
     * @return bool
     */
    public static function dateIsBetween2Dates(string $sDateIsoRangeStart = '', string $sDateIsoRangeEnd = '', string $sDateIso = '') : bool
    {
        // Fallback: today
        ('' === $sDateIso) ? $sDateIso = date('Y-m-d', strtotime(date('Y-m-d'))) : false;
        ('' === $sDateIsoRangeStart) ? $sDateIsoRangeStart = date('Y-m-d', strtotime(date('Y-m-d'))) : false;
        ('' === $sDateIsoRangeEnd) ? $sDateIsoRangeEnd = date('Y-m-d', strtotime(date('Y-m-d'))) : false;

        if (($sDateIso >= $sDateIsoRangeStart) && ($sDateIso <= $sDateIsoRangeEnd))
        {
            return true;
        }

        return false;
    }

    /**
     * returns DTDateWeekInfo object with: year, week number, start ISO date of week, end ISO date of week, first day of week, last day of week
     * @param int $iYear         default=current year; e.g: 2025
     * @param int $iCalendarWeek default=current week; e.g: 38
     * @return \MVC\DataType\DTDateWeekInfo
     * @throws \DateMalformedStringException
     * @throws \ReflectionException
     */
    public static function getWeekInfo(int $iYear = 0, int $iCalendarWeek = 0)
    {
        // set current year if empty
        if (true === empty($iYear))
        {
            $iYear = (int) date('Y');
        }

        // set current week number if empty
        if (true === empty($iCalendarWeek))
        {
            $iCalendarWeek = (int) date('W');
        }

        $oDateTime = new DateTime();
        $aDateIso['year'] = $iYear;
        $aDateIso['week'] = $iCalendarWeek;
        $aDateIso['dateStart'] = $oDateTime->setISODate($iYear, $iCalendarWeek)->format('Y-m-d');
        $aDateIso['dateEnd'] = $oDateTime->modify('+6 days')->format('Y-m-d');
        $aDateIso['dayStart'] = date('l', strtotime($aDateIso['dateStart']));
        $aDateIso['dayEnd'] = date('l', strtotime($aDateIso['dateEnd']));

        $oDTDateWeekInfo = DTDateWeekInfo::create($aDateIso);

        return $oDTDateWeekInfo;
    }
}






























