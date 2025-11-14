<?php

/**
 * truncates a string evenly distributed at the front and back to the specified total length and inserts a string (filler) in between.
 * @example <a href="/foo/bar/">{basename($oDTCdmModelTableMessageAttachment->get_path())|shrinkLink:60}</a>
 * @param string $sString
 * @param int    $iMaxChars
 * @param string $sFiller
 * @return string
 */
function smarty_modifier_shrink(string $sString = '', int $iMaxChars = 255, string $sFiller = '…')
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