<?php

/**
 * returns `<tag>`-encapsulated, highlighted html markup
 * @param string $sMarkup
 * @param string $sTag
 * @param bool   $bPurify
 * @return string
 * @package   Emvicy
 * @copyright ueffing.net
 * @author    Guido K.B.W. Üffing <emvicy@ueffing.net>
 * @license   GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */
function smarty_modifier_highlight_html(string $sMarkup = '', string $sTag = 'code', bool $bPurify = false) : string
{
    return \MVC\Strings::highlight_html($sMarkup, $sTag, $bPurify);
}


