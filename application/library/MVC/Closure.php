<?php

/**
 * Closure.php
 *
 * @package Emvicy
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <emvicy@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

namespace MVC;

use ReflectionFunction;
use ReflectionNamedType;
use ReflectionUnionType;

class Closure
{
    /**
     * checks whether the unknown parameter is a closure object
     * @param mixed $mUnknown
     * @return bool
     */
    public static function is(mixed $mUnknown) : bool
    {
        return is_object($mUnknown) && ($mUnknown instanceof \Closure);
    }

    /**
     * converts a closure into a string
     * @param \Closure $oClosure
     * @param bool $bShrink remove comments, empty lines, multiple whitespac
     * @return string
     * @throws \ReflectionException
     */
    public static function dump(\Closure $oClosure, bool $bShrink = true) : string
    {
        return self::toString($oClosure, $bShrink);
    }

    /**
     * converts a closure into a string
     * @see https://stackoverflow.com/a/69934185
     * @param \Closure $oClosure
     * @param bool $bShrink remove comments, empty lines, multiple whitespace
     * @return string
     * @throws \ReflectionException
     */
    public static function toString(\Closure $oClosure, bool $bShrink = true) : string
    {
        $oReflectionFunction = new ReflectionFunction($oClosure);
        $sFileName = $oReflectionFunction->getFileName();
        $iStartLine = $oReflectionFunction->getStartLine();
        $iEndLine = $oReflectionFunction->getEndLine();
        $aExplode = explode(PHP_EOL, file_get_contents($sFileName));
        $aExplode = array_slice($aExplode, ($iStartLine - 1), ($iEndLine - ($iStartLine - 1)));
        $iLastLineNumber = (count($aExplode) - 1);

        if (
            (substr_count(current($aExplode), 'function') > 1) ||
            (substr_count(current($aExplode), '{') > 1) ||
            (substr_count($aExplode[$iLastLineNumber], '}') > 1)
        )
        {
            Error::error(
                "Too complex context definition in: `$sFileName`. Check lines: $iStartLine & $iEndLine.",
                1,
                0,
                $sFileName,
                $iStartLine
            );
        }

        $aExplode[0] = ('function' . explode('function', current($aExplode))[1]);
        $aExplode[$iLastLineNumber] = (explode('}', $aExplode[$iLastLineNumber])[0] . '}');
        $sClosure = implode(PHP_EOL, $aExplode);

        // remove comments, empty lines, multiple whitespace
        if (true === $bShrink)
        {
            $sClosure = preg_replace('!/\*.*?\*/!s', '', $sClosure);
            $sClosure = preg_replace('/\n\s*\n/', "\n", $sClosure);
            $sClosure = preg_replace('/(?:(?:\/\*(?:[^*]|(?:\*+[^*\/]))*\*+\/)|(?:(?<!\:|\\\|\'|\")\/\/.*))/', '', $sClosure);
            $sClosure = str_replace("\n", ' ', $sClosure);
            $sClosure = preg_replace('!\s+!', ' ', $sClosure);
        }

        return (string) $sClosure;
    }
}