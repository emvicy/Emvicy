<?php

/**
 * converts "markdown" syntax into markup.
 * @package   Emvicy
 * @copyright ueffing.net
 * @author    Guido K.B.W. Üffing <emvicy@ueffing.net>
 * @license   GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 * @example   {'# title'|parsedown}
 * @param string $sMarkdown
 * @return string
 */
function smarty_modifier_parsedown(string $sMarkdown = '') : string
{
    return \MVC\Strings::parsedown($sMarkdown);
}