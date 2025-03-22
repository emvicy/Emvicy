<?php

namespace MVC;


use MVC\DataType\DTArrayObject;
use MVC\DataType\DTKeyValue;
use MVC\Http\Header;

class RequestHelper
{
    /**
     * @param string $sUrl
     * @param bool   $bReverse
     * @return array
     * @example '/foo/bar/baz/'
     *          array(3) {[0]=> string(3) "foo" [1]=> string(3) "bar" [2]=> string(3) "baz"}
     */
    public static function getPathArrayOnUrl(string $sUrl = '', bool $bReverse = false) : array
    {
        if (true === empty($sUrl))
        {
            return array();
        }

        $aUrl = parse_url($sUrl);
        $mPath = preg_split('~/~', ($aUrl['path'] ?? ''), -1, PREG_SPLIT_NO_EMPTY);
        $aPath = (false === is_array($mPath)) ? array() : $mPath;

        if (true === $bReverse)
        {
            $aPath = array_reverse($aPath);
        }

        /** @var array */
        return $aPath;
    }

    /**
     * redirects to given Location URI
     * @param string $sLocation
     * @param bool   $bReplace
     * @param int    $iResponseCode default=302
     * @return void
     * @throws \ReflectionException
     */
    public static function redirect(string $sLocation = '', bool $bReplace = true, int $iResponseCode = 302) : void
    {
        // source
        $aBacktrace = debug_backtrace(limit: 1);

        (array_key_exists('file', $aBacktrace[0]))
            ? $sFile = $aBacktrace[0]['file']
            : $sFile = '';
        (array_key_exists('line', $aBacktrace[0]))
            ? $sLine = $aBacktrace[0]['line']
            : $sLine = '';
        (array_key_exists('line', $aBacktrace))
            ? $sLine = $aBacktrace['line']
            : false;

        // standard
        Log::write(
            'Redirect to: ' . $sLocation . ' --> called in: ' . $sFile . ', ' . $sLine,
            Config::get_MVC_LOG_FILE_DEFAULT(),
            false
        );

        // CLI
        if (true === Request::in()->get_isCli())
        {
            echo trim((string) shell_exec(Config::get_MVC_BIN_PHP_BINARY() . ' index.php "' . $sLocation . '"'));

            // Event
            Event::run('mvc.request.redirect', DTArrayObject::create()
                ->add_aKeyValue(DTKeyValue::create()
                    ->set_sKey('sLocation')
                    ->set_sValue('[CLI] php index.php "' . $sLocation . '"'))
                ->add_aKeyValue(DTKeyValue::create()
                    ->set_sKey('aDebug')
                    ->set_sValue(Debug::prepareBacktraceArray((debug_backtrace(limit: 1)[0] ?? array())))));

            exit ();
        }

        // Event
        Event::run('mvc.request.redirect', DTArrayObject::create()
            ->add_aKeyValue(DTKeyValue::create()
                ->set_sKey('sLocation')
                ->set_sValue($sLocation))
            ->add_aKeyValue(DTKeyValue::create()
                ->set_sKey('bReplace')
                ->set_sValue($bReplace))
            ->add_aKeyValue(DTKeyValue::create()
                ->set_sKey('iResponseCode')
                ->set_sValue($iResponseCode))
            ->add_aKeyValue(DTKeyValue::create()
                ->set_sKey('aDebug')
                ->set_sValue(Debug::prepareBacktraceArray((debug_backtrace(limit: 1)[0] ?? array())))));

        /*
         * "Location:" header.
         * Not only does it send this header back to the browser,
         * but it also returns a REDIRECT (302) status code to the browser
         * unless the 201 or a 3xx status code has already been set.
         * - @see https://www.php.net/manual/en/function.header.php
         *
         * My note: (302) means "Found", not "redirect" due to IANA Standards.
         * Instead, a "redirect" in its meaning would be code (307) or (308)
         */
        Header::init()->Location(
            sLocation: $sLocation,
            bReplace: $bReplace,
            iResponseCode: $iResponseCode);
    }

    /**
     * parses e.g. a raw Response Header string and returns an assoc array
     * @param string $sHeader
     * @param bool   $bReturnArrayKeysLowerCase default=true
     * @return array
     */
    public static function parseRawHeader(string $sHeader = '', bool $bReturnArrayKeysLowerCase = true) : array
    {
        $aHeader = array();
        $sHeader = preg_replace('/^\r\n/m', '', $sHeader);
        $sHeader = preg_replace('/\r\n\s+/m', ' ', $sHeader);
        preg_match_all(
            '/^([^: ]+):\s(.+?(?:\r\n\s(?:.+?))*)?\r\n/m',
            $sHeader . "\r\n",
            $aMatch
        );

        foreach ($aMatch[1] as $sKey => $sValue)
        {
            $aHeader[$sValue] = (true === array_key_exists($sValue, $aHeader)) ? $aHeader[$sValue] . "\n" : '';
            $aHeader[$sValue].= $aMatch[2][$sKey];
        }

        (true === $bReturnArrayKeysLowerCase) ? $aHeader = array_change_key_case($aHeader) : false;

        return $aHeader;
    }

    /**
     * @param string $sKey
     * @param bool   $bCaseInsensitive
     * @return string
     * @throws \ReflectionException
     */
    public static function getHeaderValueOnKey(string $sKey = '', bool $bCaseInsensitive = true) : string
    {
        $aHeader = Request::in()->get_headerArray();

        // for comparison convert searched key and all header array keys to lowercase
        if (true === $bCaseInsensitive)
        {
            $sKey = strtolower($sKey);
            $aHeader = array_change_key_case($aHeader);
        }

        return (string) ($aHeader[$sKey] ?? '');
    }
}
