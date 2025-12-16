<?php

namespace MVC\_Init;

class MvcWhereis
{
    public static function do(string $sWhereIsItem = '')
    {
        $sWhereIsItem = escapeshellarg(trim($sWhereIsItem));

        ob_start();
        system('/bin/bash -c "type -p ' . $sWhereIsItem . '"', $iCode);
        $mResult = ob_get_contents();
        $sResult = trim(((false === $mResult) ? '' : $mResult));
        ob_end_clean();

        if (true === empty($sResult))
        {
            ob_start();
            system('/bin/bash -c "type -p whereis"', $iCode);
            $mWhereis = ob_get_contents();
            $sWhereis = trim(((false === $mWhereis) ? '' : $mWhereis));
            ob_end_clean();

            if (false === empty($sWhereis))
            {
                $sCmd = $sWhereis . ' ' . $sWhereIsItem;
                $sResult = \Emvicy\Emvicy::shellExecute($sCmd);
                list($sItem, $sResult) = array_filter(explode(' ', $sResult));
            }

            if (true === empty($sResult))
            {
                \MVC\Error::warning('function `' . __FUNCTION__ . '()` > requested program `' . $sWhereIsItem . '` not found.');
            }
        }

        return (string) $sResult;
    }
}
