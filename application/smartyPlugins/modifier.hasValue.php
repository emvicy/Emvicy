<?php


/**
 * checks whether there is value or not; Everything is a value, except `null` and empty string `''`
 * @param $mValue
 * @return bool
 * @license   GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 * @package   Emvicy
 * @copyright ueffing.net
 * @author    Guido K.B.W. Üffing <emvicy@ueffing.net>
 */
function smarty_modifier_hasValue($mValue) : bool
{
    return ((false === (true === empty($mValue) && false === is_numeric($mValue))) || is_bool($mValue));
}