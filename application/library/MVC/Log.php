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
	public static $iCount = 0;

	/**
	 * prepares debug output string
     * @param array $aBacktrace
     * @return string
     */
	public static function prepareDebug(array $aBacktrace = array ()) : string
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

		if (!file_exists ($sLogfile))
		{
            touch($sLogfile);

			if (!file_exists ($sLogfile))
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
        (true === (boolean) get($GLOBALS['aConfig']['MVC_LOG_DETAIL']['date'])) ? $sReport.= date ("Y-m-d H:i:s") : false;
        (true === (boolean) get($GLOBALS['aConfig']['MVC_LOG_DETAIL']['host'])) ? $sReport.= "\t" . ((array_key_exists('HTTP_HOST', $_SERVER)) ? $_SERVER['HTTP_HOST'] : '0.0.0.0') : false;
        (true === (boolean) get($GLOBALS['aConfig']['MVC_LOG_DETAIL']['env'])) ? $sReport.= "\t" . ((false !== getenv('MVC_ENV')) ? getenv('MVC_ENV') : '---?---') : false;
        (true === (boolean) get($GLOBALS['aConfig']['MVC_LOG_DETAIL']['ip'])) ? $sReport.= "\t" . ((array_key_exists('REMOTE_ADDR', $_SERVER)) ? $_SERVER['REMOTE_ADDR'] : '0.0.0.0') : false;
        (true === (boolean) get($GLOBALS['aConfig']['MVC_LOG_DETAIL']['uniqueid'])) ? $sReport.= "\t" . ((array_key_exists('MVC_UNIQUE_ID', $GLOBALS['aConfig'])) ? $GLOBALS['aConfig']['MVC_UNIQUE_ID'] : '---') : false;
        (true === (boolean) get($GLOBALS['aConfig']['MVC_LOG_DETAIL']['sessionid'])) ? $sReport.= "\t" . (('' !== session_id ()) ? session_id () : str_pad ('...........no.session', 32, '.')) : false;
        (true === (boolean) get($GLOBALS['aConfig']['MVC_LOG_DETAIL']['count'])) ? $sReport.= "\t" . self::$iCount : false;
        (true === (boolean) get($GLOBALS['aConfig']['MVC_LOG_DETAIL']['debug'])) ? $sReport.= "\t" . print_r ($sDebug, true) : false;
        (true === (boolean) get($GLOBALS['aConfig']['MVC_LOG_DETAIL']['message'])) ? $sReport.= "\t" . $mMessage : false;
        $sReport.= "\n";
        $sReport = ltrim($sReport, "\t");

		return $sReport;
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
        $sMessage = self::prepareMessage(
            $mMessage,
            self::prepareDebug(debug_backtrace())
        );

        (false == $bNewline && false == Config::get_MVC_LOG_FORCE_LINEBREAK())
            ? $sMessage = str_replace("\n", '\n', $sMessage) . "\n"
            : false;

        $sLogfile = self::prepareLogfile($sLogfile);

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

        file_put_contents(
            $sLogfile,
            $sMessage,
            FILE_APPEND
        );
    }

    /**
     * @return string
     * @throws \ReflectionException
     */
    public static function getLogFileDefault() : string
    {
        $sLogFileDefault = Config::get_MVC_LOG_FILE_DEFAULT();

        if (false === file_exists($sLogFileDefault))
        {
            $sLogFileDefault = realpath(__DIR__ . '/../../') . '/log/default.log';
        }

        return $sLogFileDefault;
    }
}