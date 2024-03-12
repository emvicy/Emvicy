<?php


/**
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
    $oParsedown = new \Parsedown();
    $sMarkup = $oParsedown->text($sMarkdown);

    $sStart = '<p>';
    $sEnd = '</p>';

    (true === str_starts_with($sMarkup, $sStart)) ? $sMarkup = substr($sMarkup, strlen($sStart)) : false;
    (true === str_ends_with($sMarkup, $sEnd)) ? $sMarkup = substr($sMarkup, 0, (strlen($sMarkup) - strlen($sEnd))) : false;

    return $sMarkup;
}