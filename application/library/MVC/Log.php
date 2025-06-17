<?php
/**
 * Log.php
 *
 * @package Emvicy
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <emvicy@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

namespace MVC;

/**
 * Log
 */
class Log
{
    /**
     * @var int
     */
    public static int $iCount = 0;

    /**
     * prepares debug output string
     * @param array $aBacktrace
     * @return string
     */
    public static function prepareDebug(array $aBacktrace = array()) : string
    {
        $aData = Debug::prepareBacktraceArray($aBacktrace);

        if (true === str_starts_with($aData['sFile'], $GLOBALS['aConfig']['MVC_BASE_PATH']))
        {
            $aData['sFile'] = substr($aData['sFile'], strlen($GLOBALS['aConfig']['MVC_BASE_PATH']));
        }

        return $aData['sFile'] . ', ' . $aData['sLine'];
    }

    /**
     * prepares logfile
     * @param string $sLogfile
     * @return string
     * @throws \ReflectionException
     */
    public static function prepareLogfile(string $sLogfile = '') : string
    {
        // make sure it is a logfile inside the configured log directory
        ($sLogfile === '')
            ? $sLogfile = self::getLogFileDefault()
            : ($sLogfile = pathinfo (self::getLogFileDefault(), PATHINFO_DIRNAME) . '/' . basename ($sLogfile));

        if (false === empty($sLogfile) && false === file_exists($sLogfile))
        {
            touch($sLogfile);

            if (false === file_exists($sLogfile))
            {
                Error::error('cannot create logfile: ' . $sLogfile);
            }
        }

        return $sLogfile;
    }

    /**
     * prepares message
     * @param mixed $mMessage
     * @param string $sDebug
     * @return string
     */
    public static function prepareMessage(mixed $mMessage = '', string $sDebug = '') : string
    {
        if (is_array ($mMessage))
        {
            $mMessage = print_r($mMessage, true);
        }

        if (is_object($mMessage))
        {
            ob_start();
            var_dump($mMessage);
            $mMessage = ob_get_contents();
            ob_end_clean();
        }

        // count 1 up
        self::$iCount++;

        $sReport = '';
        (true === (boolean) ($GLOBALS['aConfig']['MVC_LOG_DETAIL']['date'] ?? null)) ? $sReport.= date ("Y-m-d H:i:s") : false;
        $sReport.= "\t" . getmypid();
        (true === (boolean) ($GLOBALS['aConfig']['MVC_LOG_DETAIL']['host'] ?? null)) ? $sReport.= "\t" . ((array_key_exists('HTTP_HOST', $_SERVER)) ? $_SERVER['HTTP_HOST'] : '0.0.0.0') : false;
        (true === (boolean) ($GLOBALS['aConfig']['MVC_LOG_DETAIL']['env'] ?? null)) ? $sReport.= "\t" . ((false !== getenv('MVC_ENV')) ? getenv('MVC_ENV') : '---?---') : false;
        (true === (boolean) ($GLOBALS['aConfig']['MVC_LOG_DETAIL']['ip'] ?? null)) ? $sReport.= "\t" . \MVC\Request::getTheIpAddress() : false;
        (true === (boolean) ($GLOBALS['aConfig']['MVC_LOG_DETAIL']['uniqueid'] ?? null)) ? $sReport.= "\t" . ((array_key_exists('MVC_UNIQUE_ID', $GLOBALS['aConfig'])) ? $GLOBALS['aConfig']['MVC_UNIQUE_ID'] : '---') : false;
        (true === (boolean) ($GLOBALS['aConfig']['MVC_LOG_DETAIL']['sessionid'] ?? null)) ? $sReport.= "\t" . (('' !== session_id ()) ? session_id () : str_pad ('...........no.session', 32, '.')) : false;
        (true === (boolean) ($GLOBALS['aConfig']['MVC_LOG_DETAIL']['count'] ?? null)) ? $sReport.= "\t" . self::$iCount : false;
        (true === (boolean) ($GLOBALS['aConfig']['MVC_LOG_DETAIL']['debug'] ?? null)) ? $sReport.= "\t" . print_r ($sDebug, true) : false;
        (true === (boolean) ($GLOBALS['aConfig']['MVC_LOG_DETAIL']['message'] ?? null)) ? $sReport.= "\t" . $mMessage : false;
        $sReport.= "\n";

        return ltrim($sReport, "\t");
    }

    /**
     * Writes a Message into Logfile
     * @param mixed  $mMessage
     * @param string $sLogfile OPTIONAL Logfilename. It is going to be created if it does not exist, it will be in the same dir of the default logfile
     * @param bool   $bNewline OPTIONAL default=true; linebreak in logfile true|false
     * @return void
     * @throws \ReflectionException
     */
    public static function write(mixed $mMessage, string $sLogfile = '', bool $bNewline = true) : void
    {
        $sLogfile = self::prepareLogfile($sLogfile);

        if (true === empty($sLogfile)) {return;}
        if ($sLogfile === Config::get_MVC_LOG_FILE_SQL() && false === Config::get_MVC_LOG_SQL()) {return;}
        if ($sLogfile === Config::get_MVC_LOG_FILE_EVENT() && false === Config::get_MVC_LOG_EVENT()) {return;}
        if ($sLogfile === Config::get_MVC_LOG_FILE_EVENT_RUN() && false === Config::get_MVC_LOG_EVENT_RUN()) {return;}
        if ($sLogfile === Config::get_MVC_LOG_FILE_POLICY() && false === Config::get_MVC_LOG_POLICY()) {return;}
        if ($sLogfile === Config::get_MVC_LOG_FILE_POLICY() && false === Config::get_MVC_LOG_POLICY()) {return;}
        if ($sLogfile === Config::get_MVC_LOG_FILE_ERROR() && false === Config::get_MVC_LOG_ERROR()) {return;}
        if ($sLogfile === Config::get_MVC_LOG_FILE_WARNING() && false === Config::get_MVC_LOG_WARNING()) {return;}
        if ($sLogfile === Config::get_MVC_LOG_FILE_NOTICE() && false === Config::get_MVC_LOG_NOTICE()) {return;}
        if ($sLogfile === Config::get_MVC_LOG_FILE_REQUEST() && false === Config::get_MVC_LOG_REQUEST()) {return;}
        if ($sLogfile === Config::get_MVC_LOG_FILE_DEFAULT() && false === Config::get_MVC_LOG_DEFAULT()) {return;}
        if ($sLogfile === Config::get_MVC_LOG_FILE_ROUTEINTERVALL() && false === Config::get_MVC_LOG_ROUTEINTERVALL()) {return;}
        if ($sLogfile === Config::get_MVC_LOG_FILE_PROCESS() && false === Config::get_MVC_LOG_PROCESS()) {return;}
        if ($sLogfile === Config::get_MVC_LOG_FILE_QUEUE() && false === Config::get_MVC_LOG_QUEUE()) {return;}
        if ($sLogfile === Config::get_MVC_LOG_FILE_CRON() && false === Config::get_MVC_LOG_FILE_CRON()) {return;}

        $sMessage = self::prepareMessage(
            $mMessage,
            self::prepareDebug(debug_backtrace(limit: 2))
        );

        (false == $bNewline && false == Config::get_MVC_LOG_FORCE_LINEBREAK())
            ? $sMessage = str_replace("\n", '\n', $sMessage) . "\n"
            : false;

        file_put_contents(
            $sLogfile,
            $sMessage,
            FILE_APPEND
        );
    }

    /**
     * @return string
     */
    public static function getLogFileDefault() : string
    {
        $sLogFileDir = ($GLOBALS['aConfig']['MVC_LOG_FILE_DIR'] ?? null);
        $sLogFileDefault = ($GLOBALS['aConfig']['MVC_LOG_FILE_DEFAULT'] ?? null);

        if (true === empty($sLogFileDir) || true === empty($sLogFileDefault))
        {
            return '';
        }

        // log file dir is missing
        if (false === file_exists($sLogFileDir))
        {
            mkdir(
                $sLogFileDir,
                0754,
                true
            );
        }

        // default log file is missing
        if (false === file_exists($sLogFileDefault))
        {
            touch($sLogFileDefault);
        }

        return $sLogFileDefault;
    }
}