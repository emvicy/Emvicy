<?php

/**
 * @package Emvicy
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <emvicy@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 * @param int    $iTimestamp
 * @param string $sFormat
 * @return string
 */
function smarty_modifier_dateformat(int $iTimestamp, string $sFormat = 'Y-m-d H:i:s') : string
{
    return date($sFormat, $iTimestamp);
}