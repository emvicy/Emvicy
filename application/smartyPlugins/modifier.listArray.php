<?php

/**
 * @package Emvicy
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <emvicy@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 * @example {$aData|listArray}
 * @param $aData
 * @return string
 */
function smarty_modifier_listArray($aData) : string
{
    return \MVC\Strings::ulli($aData);
}
