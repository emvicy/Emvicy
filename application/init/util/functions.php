<?php

use MVC\Log;

/**
 * @param string $sEnvFile
 * @return void
 */
function storeEnv(string $sEnvFile = '')
{
    (true === empty($sEnvFile))
        ? $sEnvFile = realpath(__DIR__ . '/../../../') . '/.env'
        : false
    ;

    if (true === file_exists($sEnvFile))
    {
        $aEnvContent = array_values(array_filter(file($sEnvFile), 'trim'));

        foreach ($aEnvContent as $sLine)
        {
            $sLine = trim($sLine);

            // skip comment lines
            if ('#' === substr($sLine, 0, 1))
            {
                continue;
            }

            // simply set
            putenv($sLine);
            $sLine = null;
            unset ($sLine);
        }

        $aEnvContent = null;
        unset($aEnvContent);
    }
    else
    {
        $sMessage = "missing file:\n" . $sEnvFile . "\n\n";
        echo (('cli' != php_sapi_name()) ? nl2br($sMessage) : $sMessage . "\n");
        (false === getenv('emvicy')) ? exit() : false;
    }

    $sEnvFile = null;
    unset($sEnvFile);
}

/**
 * Closure
 * @param array $aConfig
 * @return array|void
 */
$cLoadConfigforMain = function (array $aConfig = array()) {

    if (count($aConfig['MVC_MODULE_PRIMARY']) > 1)
    {
        $sMessage = '<div class="alert alert-danger" role="alert"><center>'
                    . "<h1>⚠️</h1><p><b>There is more than one primary module, <br>but you can only have one. <br><br>Detected primary modules: <br><pre>'" . implode("','", $aConfig['MVC_MODULE_PRIMARY']) . "'</pre>\n\n"
                    . '- EOM -</b></p></center></div>';
        echo (true === $aConfig['MVC_CLI']) ? strip_tags($sMessage) : $sMessage;
        exit(1);
    }

    $aConfig['MVC_MODULE_SECONDARY'] = array_diff(array_filter(array_map(function ($sValue) use ($aConfig){
        return str_replace($aConfig['MVC_MODULES_DIR'] . '/', '', $sValue);
    }, glob($aConfig['MVC_MODULES_DIR'] . '/*', GLOB_ONLYDIR)), 'trim'), $aConfig['MVC_MODULE_PRIMARY']);

    $aConfig['MVC_MODULE_SET'] = array(
        'SECONDARY' => $aConfig['MVC_MODULE_SECONDARY'],    # handle 'SECONDARY' first
        'PRIMARY' => $aConfig['MVC_MODULE_PRIMARY'],        # handle 'PRIMARY' second
    );

    // load requirements from /application/init/util/_mvc.php
    require $aConfig['MVC_APPLICATION_INIT_DIR'] . '/util/_mvc.php';

    return $aConfig;
};

/**
 * Closure
 * @param array $aConfig
 * @return array
 */
$cLoadConfigforModule = function (array $aConfig) {

    // Modules
    foreach ($aConfig['MVC_MODULE_SET'] as $sType => $aModule)
    {
        // walk modules
        foreach ($aModule as $sModule)
        {
            if (file_exists($aConfig['MVC_MODULES_DIR'] . '/' . $sModule . '/etc/config/'))
            {
                // load common config files
                foreach (glob ($aConfig['MVC_MODULES_DIR'] . '/' . $sModule . '/etc/config/*.php') as $sFile)
                {
                    require $sFile;
                }

                // load staging config
                $sConfigFileName =
                    $aConfig['MVC_MODULES_DIR'] . '/' . $sModule
                    . '/etc/config/'
                    . basename($sModule)
                    . '/config/'
                    . getenv('MVC_ENV')
                    . '.php';

                if (file_exists($sConfigFileName))
                {
                    require $sConfigFileName;
                }

                // External composer Libraries
                $sVendorAutoload = $aConfig['MVC_MODULES_DIR'] . '/' . $sModule . '/etc/config/' . basename($sModule) . '/vendor/autoload.php';

                if (file_exists($sVendorAutoload))
                {
                    require $sVendorAutoload;
                }
            }
        }
    }

    return $aConfig;
};

/**
 * Closure
 * @param array $aConfig
 * @return void
 * @throws \ReflectionException
 */
$cAutoload = function (array $aConfig) {

    // set Include paths
    set_include_path (
        get_include_path ()

        // MVC Application
        . PATH_SEPARATOR . $aConfig['MVC_PERSIST']
        . PATH_SEPARATOR . $aConfig['MVC_LIBRARY']
        . PATH_SEPARATOR . $aConfig['MVC_MODULES_DIR']
        . PATH_SEPARATOR . implode (PATH_SEPARATOR, $aConfig['MVC_SMARTY_PLUGINS_DIR'])
    );

    require $aConfig['MVC_BASE_PATH'] . '/application/vendor/autoload.php';

    // PSR4 autoloader
    spl_autoload_register(function ($sClassName) {

        $sFileName = str_replace('\\', DIRECTORY_SEPARATOR, $sClassName) . '.php';

        if (true === ($aConfig['MVC_LOG_AUTOLOADER'] ?? false))
        {
            if (true === class_exists('\MVC\Log') && (true === class_exists('\MVC\Request')) && array_key_exists('REMOTE_ADDR', $_SERVER))
            {
                \MVC\Log::write('AUTOLOADING' . "\t" . $sFileName);
            }
        }

        require_once $sFileName;
    });
};

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

/**
 * locates source/binary for a specified file
 * @param string $sWhereIsItem
 * @return string
 * @throws \ReflectionException
 */
function whereis(string $sWhereIsItem = '')
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