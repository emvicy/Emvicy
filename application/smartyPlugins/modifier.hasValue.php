<?php


/**
 * checks whether there is value or not; Everything is a value, except `null` and empty string `''`
 * @param $mValue
 * @return bool
 */
function smarty_modifier_hasValue($mValue)
{
    return ((false === (true === empty($mValue) && false === is_numeric($mValue))) || is_bool($mValue));
}