<?php

#--------------------------------------------------------------------------------
#

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
 * displays the time passed from start until calling this method
 * @return float
 * @throws \ReflectionException
 */
function dct()
{
    display(ct(), debug_backtrace(limit: 2));
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

if (!function_exists('getallheaders'))
{
    /**
     * @return array
     */
    function getallheaders()
    {
        $aHeader = [];

        foreach ($_SERVER as $name => $value)
        {
            if (substr($name, 0, 5) == 'HTTP_')
            {
                $aHeader[str_replace(' ', '-', ucwords(strtolower(str_replace('_', ' ', substr($name, 5)))))] = $value;
            }
        }

        return $aHeader;
    }
}

/**
 * reads environment key/values from a given file
 * and stores them via putenv so that they will be accessible via getenv()
 * @param string $sEnvFile
 * @return void
 */
function mvcStoreEnv(string $sEnvFile = '')
{
echo microtime(true) . ', ' . __FILE__ . ', ' . __LINE__ . "<br>\n" . str_repeat('-', 80) . "<br>\n";
die("die at: " . __FILE__ . ', ' . __LINE__ . "<br>\n" . str_repeat('-', 80) . "<br>\n");

    (true === empty($sEnvFile))
        ? $sEnvFile = realpath(__DIR__ . '/../../../') . '/.env'
        : false
    ;

    if (file_exists($sEnvFile))
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
 * @param array $aConfig
 * @return array
 */
function mvcConfigLoader(array $aConfig = array())
{
echo microtime(true) . ', ' . __FILE__ . ', ' . __LINE__ . "<br>\n" . str_repeat('-', 80) . "<br>\n";
die("die at: " . __FILE__ . ', ' . __LINE__ . "<br>\n" . str_repeat('-', 80) . "<br>\n");

    #-----------------------------
    # main config

    // place of main Emvicy config
    $aConfig['MVC_CONFIG_DIR'] = realpath(__DIR__ . '/../../../') . '/config';

    // load main config from /config/*.php
    foreach (glob ($aConfig['MVC_CONFIG_DIR'] . '/*.php') as $sFile)
    {
        require_once $sFile;
        $sFile = null;
        unset ($sFile);
    }

    #-----------------------------
    # module config

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
                    require_once $sFile;
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
                    include_once $sConfigFileName;
                }

                // External composer Libraries
                $sVendorAutoload = $aConfig['MVC_MODULES_DIR'] . '/' . $sModule . '/etc/config/' . basename($sModule) . '/vendor/autoload.php';

                if (file_exists($sVendorAutoload))
                {
                    require_once $sVendorAutoload;
                }
            }
        }
    }

    #-----------------------------

    // load requirements from /application/init/util/_mvc.php
    require_once __DIR__ . '/_mvc.php';

    return $aConfig;
}

/**
 * locates source/binary for a specified file
 * @param string $sWhereIsItem
 * @return string
 * @throws \ReflectionException
 */
function whereis(string $sWhereIsItem = '')
{
echo microtime(true) . ', ' . __FILE__ . ', ' . __LINE__ . "<br>\n" . str_repeat('-', 80) . "<br>\n";
die("die at: " . __FILE__ . ', ' . __LINE__ . "<br>\n" . str_repeat('-', 80) . "<br>\n");

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

/**
 * @param int $iAmount
 * @return void
 */
function nl(int $iAmount = 1)
{
    echo str_repeat("\n", $iAmount);
}

/**
 * @param string $sString
 * @param int $iLength
 * @param $sColor
 * @return void
 */
function hr(string $sString = '-', int $iLength = 80, $sColor = "\033[0m")
{
    nl();
    echo $sColor . str_repeat($sString, $iLength) . "\033[0m";
    nl();
}

//-----------------------
// @credits https://www.php.net/manual/en/function.parse-str.php#126789

const PSCperiod = 'XXXPSCperiodXXX';
const PSCspace = 'ZZZPSCspaceZZZ';

/**
 * @param $aArray
 * @param $sQueryString
 * @return void
 */
function PSCsanitizeKeys(&$aArray, $sQueryString)
{
    foreach ($aArray as $key => $val)
    {
        // restore values to original
        $newval = $val;

        if (is_string($val))
        {
            $newval = str_replace([PSCperiod, PSCspace], [".", " "], $val);
        }

        $newkey = str_replace([PSCperiod, PSCspace], [".", " "], $key);

        if (str_contains($newkey, '_'))
        {
            // periode of space or [ or ] converted to _. Restore with querystring
            $regex = '/&(' . str_replace('_', '[ \.\[\]]', preg_quote($newkey, '/')) . ')=/';
            $matches = null;

            if (preg_match_all($regex, "&" . urldecode($sQueryString), $matches))
            {
                if (count(array_unique($matches[1])) === 1 && $key != $matches[1][0])
                {
                    $newkey = $matches[1][0];
                }
            }
        }

        if ($newkey != $key)
        {
            unset($aArray[$key]);
            $aArray[$newkey] = $newval;
        }
        elseif ($val != $newval)
        {
            $aArray[$key] = $newval;
        }

        if (is_array($val))
        {
            PSCsanitizeKeys($aArray[$newkey], $sQueryString);
        }
    }
}

/**
 * leaves key names preserved
 * @param $querystr
 * @param $arr
 * @return array|null
 */
function parse_str_clean($querystr, &$arr): array
{
    // without the converting of spaces and dots etc to underscores.
    $qquerystr = str_ireplace(['.', '%2E', '+', ' ', '%20'], [
        PSCperiod,
        PSCperiod,
        PSCspace,
        PSCspace,
        PSCspace,
    ], $querystr);
    $arr = null;
    parse_str($qquerystr, $arr);
    PSCsanitizeKeys($arr, $querystr);

    return $arr;
}

/**
 * returns an assoc array based on phpinfo information.
 * @return array
 */
function phpinfo_array()
{
    ob_start();
    phpinfo();
    $aInfo = array();
    $aInfoLine = explode("\n", strip_tags(ob_get_clean(), "<tr><td><h2>"));
    $sCategory = 'General';

    foreach ($aInfoLine as $sLine)
    {
        preg_match("~<h2>(.*)</h2>~", $sLine, $sTitle)
            ? $sCategory = trim($sTitle[1])
            : null
        ;

        if (preg_match("~<tr><td[^>]+>([^<]*)</td><td[^>]+>([^<]*)</td></tr>~", $sLine, $aValue))
        {
            $aInfo[$sCategory][trim($aValue[1])] = trim($aValue[2]);
        }
        elseif (preg_match("~<tr><td[^>]+>([^<]*)</td><td[^>]+>([^<]*)</td><td[^>]+>([^<]*)</td></tr>~", $sLine, $aValue))
        {
            $aInfo[$sCategory][trim($aValue[1])] = array("local" => trim($aValue[2]), "master" => trim($aValue[3]));
        }
    }

    return \MVC\Arr::changeKeyCaseRecursively($aInfo);
}

/**
 * @param string $sTag
 * @return string
 * @throws \ReflectionException
 */
function href(string $sTag = '')
{
    return \MVC\Route::getOnTag($sTag)->get_path();
}