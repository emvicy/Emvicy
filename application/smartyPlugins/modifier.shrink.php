<?php

/**
 * truncates a string evenly distributed at the front and back to the specified total length and inserts a string (filler) in between.
 * @param string $sString
 * @param int    $iMaxChars
 * @param string $sFiller
 * @return string
 * @license   GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 * @package   Emvicy
 * @copyright  ueffing.net
 * @author    Guido K.B.W. Üffing <emvicy@ueffing.net>
 * @example   <a href="/foo/bar/">{basename($oDTCdmModelTableMessageAttachment->get_path())|shrinkLink:60}</a>
 */
function smarty_modifier_shrink(string $sString = '', int $iMaxChars = 255, string $sFiller = '…') : string
{
    $iStrLen = strlen($sString);
    $iStrLenFiller = strlen($sFiller);

    if ($iStrLen <= $iMaxChars)
    {
        return $sString;
    }

    $iChunksize = (int) floor(($iMaxChars - $iStrLenFiller) / 2);

    return substr($sString, 0, $iChunksize) . $sFiller . substr($sString, -$iChunksize);
}