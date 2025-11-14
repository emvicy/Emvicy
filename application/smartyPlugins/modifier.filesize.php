<?php

/**
 * converts byte into Byte, Kilobyte, Megabyte, Gigabyte, Terabyte, Petabyte
 * @param string $sByte
 * @param int    $iDecimals
 * @return string
 * @license   GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 * @package   Emvicy
 * @copyright ueffing.net
 * @author    Guido K.B.W. Üffing <emvicy@ueffing.net>
 */
function smarty_modifier_filesize(string $sByte, int $iDecimals = 2) : string
{
    $sKey = 'BKMGTP';
    $iFactor = (int) floor((strlen($sByte) - 1) / 3);
    return sprintf(
       "%.{$iDecimals}f",
       $sByte / pow(1024, $iFactor)
   ) . @$sKey[$iFactor];
}