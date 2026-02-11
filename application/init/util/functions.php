<?php

/**
 * shorthand for `Debug::display()` on userland
 * @param mixed $mData
 * @param array $aDebugBacktrace
 * @return void
 */
function display(mixed $mData = '', array $aDebugBacktrace = array())
{
    if (true === class_exists('\MVC\Debug', true))
    {
        \MVC\Debug::display($mData, (false === empty($aDebugBacktrace)) ? $aDebugBacktrace : debug_backtrace(limit: 2));
    }
}

/**
 * shorthand for `Debug::info()` on userland
 * @param mixed $mData
 * @return void
 */
function info(mixed $mData = '')
{
    if (true === class_exists('\MVC\Debug', true))
    {
        \MVC\Debug::info($mData, debug_backtrace(limit: 2));
    }
}

/**
 * dumps data using print_r
 * @example pr(get_include_path(), ':');
 * @param mixed  $mData
 * @param string $sSeparator optional works on strings
 * @return void
 */
function pr($mData, string $sSeparator = "\n")
{
    if (true === is_string($mData))
    {
        echo ('cli' === php_sapi_name())
            ? print_r(array_filter(explode($sSeparator, $mData)), true) . "\n"
            : '<pre>' . print_r(array_filter(explode($sSeparator, $mData)), true) . '</pre><hr>';
    }
    elseif (true === is_array($mData))
    {
        echo ('cli' === php_sapi_name())
            ? print_r(array_filter($mData), true) . "\n"
            : '<pre>' . print_r(array_filter($mData), true) . '</pre><hr>';
    }
    else
    {
        echo ('cli' === php_sapi_name())
            ? print_r($mData) . "\n"
            : '<pre>' . print_r($mData) . '</pre><hr>';
    }
}

/**
 * @return void
 * @throws \ReflectionException
 */
function stop()
{
    if (
        (false === class_exists('\MVC\Debug', true)) ||
        (false === class_exists('\MVC\Request', true))
    )
    {
        die("\nstop at: \n- File: " . debug_backtrace(limit: 1)[0]['file']. "\n- Line: " . debug_backtrace(limit: 1)[0]['line'] . "\n");
    }

    $aDebug = \MVC\Debug::prepareBacktraceArray(debug_backtrace(limit: 2));
    $sMessage = "\n<pre>stop at:\n- File: " . $aDebug['sFile'] . "\n- Line: " . $aDebug['sLine'] . "\n";
    (!empty(($aDebug['sClass'] ?? null))) ? $sMessage.="- Method: " . $aDebug['sClass'] . "::" . $aDebug['sFunction'] : false;
    $sMessage.= "\n" . 'Construction Time: ' . ct() . ' s' . "</pre>";
    ('cli' === strtolower(php_sapi_name())) ? $sMessage = strip_tags($sMessage): false;
    die($sMessage . "\n\n");
}

/**
 * @return float
 * @throws \ReflectionException
 */
function ct()
{
    return \MVC\Debug::constructionTime();
}

///**
// * displays the time passed from start until calling this method
// * @return float
// * @throws \ReflectionException
// */
//function dct()
//{
//    display(ct(), debug_backtrace(limit: 2));
//}
//
//if (!function_exists('getallheaders'))
//{
//    /**
//     * @return array
//     */
//    function getallheaders()
//    {
//        $aHeader = [];
//
//        foreach ($_SERVER as $name => $value)
//        {
//            if (substr($name, 0, 5) == 'HTTP_')
//            {
//                $aHeader[str_replace(' ', '-', ucwords(strtolower(str_replace('_', ' ', substr($name, 5)))))] = $value;
//            }
//        }
//
//        return $aHeader;
//    }
//}
//
///**
// * @param int $iAmount
// * @return void
// */
//function nl(int $iAmount = 1)
//{
//    echo str_repeat("\n", $iAmount);
//}
//
///**
// * @param string $sString
// * @param int $iLength
// * @param $sColor
// * @return void
// */
//function hr(string $sString = '-', int $iLength = 80, $sColor = "\033[0m")
//{
//    nl();
//    echo $sColor . str_repeat($sString, $iLength) . "\033[0m";
//    nl();
//}
//
///**
// * returns an assoc array based on phpinfo information.
// * @return array
// */
//function phpinfo_array()
//{
//    ob_start();
//    phpinfo();
//    $aInfo = array();
//    $aInfoLine = explode("\n", strip_tags(ob_get_clean(), "<tr><td><h2>"));
//    $sCategory = 'General';
//
//    foreach ($aInfoLine as $sLine)
//    {
//        preg_match("~<h2>(.*)</h2>~", $sLine, $sTitle)
//            ? $sCategory = trim($sTitle[1])
//            : null
//        ;
//
//        if (preg_match("~<tr><td[^>]+>([^<]*)</td><td[^>]+>([^<]*)</td></tr>~", $sLine, $aValue))
//        {
//            $aInfo[$sCategory][trim($aValue[1])] = trim($aValue[2]);
//        }
//        elseif (preg_match("~<tr><td[^>]+>([^<]*)</td><td[^>]+>([^<]*)</td><td[^>]+>([^<]*)</td></tr>~", $sLine, $aValue))
//        {
//            $aInfo[$sCategory][trim($aValue[1])] = array("local" => trim($aValue[2]), "master" => trim($aValue[3]));
//        }
//    }
//
//    return \MVC\Arr::changeKeyCaseRecursively($aInfo);
//}
//
////-----------------------
//// @credits https://www.php.net/manual/en/function.parse-str.php#126789
//
//const PSCperiod = 'XXXPSCperiodXXX';
//const PSCspace = 'ZZZPSCspaceZZZ';
//
///**
// * @param $aArray
// * @param $sQueryString
// * @return void
// */
//function PSCsanitizeKeys(&$aArray, $sQueryString)
//{
//    foreach ($aArray as $sKey => $mValue)
//    {
//        // restore values to original
//        $mNewValue = $mValue;
//
//        if (true === is_string($mValue))
//        {
//            $mNewValue = str_replace([PSCperiod, PSCspace], [".", " "], $mValue);
//        }
//
//        $sNewkey = str_replace([PSCperiod, PSCspace], [".", " "], $sKey);
//
//        if (true === str_contains($sNewkey, '_'))
//        {
//            // periode of space or [ or ] converted to _. Restore with querystring
//            $sRegex = '/&(' . str_replace('_', '[ \.\[\]]', preg_quote($sNewkey, '/')) . ')=/';
//            $aMatch = null;
//
//            if (preg_match_all($sRegex, "&" . urldecode($sQueryString), $aMatch))
//            {
//                if (count(array_unique($aMatch[1])) === 1 && $sKey != $aMatch[1][0])
//                {
//                    $sNewkey = $aMatch[1][0];
//                }
//            }
//        }
//
//        if ($sNewkey != $sKey)
//        {
//            unset($aArray[$sKey]);
//            $aArray[$sNewkey] = $mNewValue;
//        }
//        elseif ($mValue != $mNewValue)
//        {
//            $aArray[$sKey] = $mNewValue;
//        }
//
//        if (true === is_array($mValue))
//        {
//            PSCsanitizeKeys($aArray[$sNewkey], $sQueryString);
//        }
//    }
//}
//
///**
// * leaves key names preserved
// * @param $sQueryString
// * @param $aData
// * @return array|null
// */
//function parse_str_clean($sQueryString, &$aData): array
//{
//    // without the converting of spaces and dots etc to underscores.
//    $sQquerystr = str_ireplace(['.', '%2E', '+', ' ', '%20'], [
//        PSCperiod,
//        PSCperiod,
//        PSCspace,
//        PSCspace,
//        PSCspace,
//    ], $sQueryString);
//    $aData = null;
//    parse_str($sQquerystr, $aData);
//    PSCsanitizeKeys($aData, $sQueryString);
//
//    return $aData;
//}