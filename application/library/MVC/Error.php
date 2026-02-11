<?php
/**
 * Error.php
 *
 * @package Emvicy
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <emvicy@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

namespace MVC;

use Errorexception;
use Exception;
use MVC\DataType\DTArrayObject;
use MVC\DataType\DTKeyValue;

/**
 * Error
 */
class Error
{
    /**
     * @var array
     */
    public static array $aExceptionTranslation = [
        E_ERROR => "E_ERROR",
        E_WARNING => "E_WARNING",
        E_PARSE => "E_PARSE",
        E_NOTICE => "E_NOTICE",
        E_CORE_ERROR => "E_CORE_ERROR",
        E_CORE_WARNING => "E_CORE_WARNING",
        E_COMPILE_ERROR => "E_COMPILE_ERROR",
        E_COMPILE_WARNING => "E_COMPILE_WARNING",
        E_USER_ERROR => "E_USER_ERROR",
        E_USER_WARNING => "E_USER_WARNING",
        E_USER_NOTICE => "E_USER_NOTICE",
        2048 => "E_STRICT", # Constant `E_STRICT` is deprecated
        E_RECOVERABLE_ERROR => "E_RECOVERABLE_ERROR",
        E_DEPRECATED => "E_DEPRECATED",
        E_USER_DEPRECATED => "E_USER_DEPRECATED",
        E_ALL => "E_ALL",
    ];

    /**
     * @var array
     */
    protected static array $_aError = array();

    /**
     * sets error handlers;
     * bind event 'mvc.error' to function
     * @return void
     * @throws \ReflectionException
     */
    public static function init() : void
    {
        register_shutdown_function ("\MVC\Error::fatal");
        set_error_handler ("\MVC\Error::errorHandler");
        set_exception_handler ("\MVC\Error::exception");

        Event::bind ('mvc.error', function(DTArrayObject $oDTArrayObject) {
            Error::addERROR ($oDTArrayObject);
        });
    }

    /**
     * this catches an error on runtime, creates a new ErrorException Object of it and passes it to Exception Handler
     * @param int    $iCode
     * @param string $sMessage
     * @param string $sFilename
     * @param int    $iLineNr
     * @return void
     * @throws \ReflectionException
     */
    public static function errorHandler(int $iCode, string $sMessage, string $sFilename, int $iLineNr) : void
    {
        $oErrorException = new Errorexception($sMessage, $iCode, 1, $sFilename, $iLineNr);

        self::exception($oErrorException);
    }

    /**
     * Error handler, passes flow over the exception logger with new ErrorException.
     * @param string $sMessage
     * @param int    $iCode
     * @param int    $iSeverity
     * @param string $sFilename
     * @param int    $iLineNr
     * @return void
     * @throws \ReflectionException
     */
    public static function error (string $sMessage = '', int $iCode = E_ERROR, int $iSeverity = 0, string $sFilename = '', int $iLineNr = 0) : void
    {
        $aDebug = Debug::prepareBacktraceArray(debug_backtrace(limit: 2));
        (true === empty($sFilename)) ? $sFilename = $aDebug['sFile'] : false;
        (true === empty($iLineNr)) ? $iLineNr = $aDebug['sLine'] : false;
        $oErrorException = new Errorexception($sMessage, $iCode, $iSeverity, $sFilename, (int) $iLineNr );

        self::exception($oErrorException);
    }

    /**
     * @param string $sMessage
     * @param int    $iCode
     * @param int    $iSeverity
     * @param string $sFilename
     * @param int    $iLineNr
     * @return void
     * @throws \ReflectionException
     */
    public static function warning (string $sMessage = '', int $iCode = E_WARNING, int $iSeverity = 0, string $sFilename = '', int $iLineNr = 0) : void
    {
        $aDebug = Debug::prepareBacktraceArray(debug_backtrace(limit: 2));
        (true === empty($sFilename)) ? $sFilename = $aDebug['sFile'] : false;
        (true === empty($iLineNr)) ? $iLineNr = (int) $aDebug['sLine'] : false;
        $oErrorException = new Errorexception($sMessage, $iCode, $iSeverity, $sFilename, $iLineNr );

        self::exception($oErrorException);
    }

    /**
     * @param string $sMessage
     * @param int    $iCode
     * @param int    $iSeverity
     * @param string $sFilename
     * @param int    $iLineNr
     * @return void
     * @throws \ReflectionException
     */
    public static function notice (string $sMessage = '', int $iCode = E_NOTICE, int $iSeverity = 0, string $sFilename = '', int $iLineNr = 0) : void
    {
        $aDebug = Debug::prepareBacktraceArray(debug_backtrace(limit: 2));
        (true === empty($sFilename)) ? $sFilename = $aDebug['sFile'] : false;
        (true === empty($iLineNr)) ? $iLineNr = (int) $aDebug['sLine'] : false;
        $oErrorException = new Errorexception($sMessage, $iCode, $iSeverity, $sFilename, $iLineNr );

        self::exception($oErrorException);
    }

    /**
     * @param \Error|\Exception $oErrorException
     * @return void
     * @throws \ReflectionException
     */
    public static function exception(\Error|Exception $oErrorException) : void
    {
        $sLogfile = Config::get_MVC_LOG_FILE_ERROR();
        $sMsg = '';

        /** @var \ErrorException $oErrorException */
        if (method_exists ($oErrorException, 'getSeverity'))
        {
            if (in_array ($oErrorException->getCode(), array (E_WARNING, E_CORE_WARNING, E_COMPILE_WARNING, E_USER_WARNING)))
            {
                $sLogfile = Config::get_MVC_LOG_FILE_WARNING();
            }

            if (in_array ($oErrorException->getCode(), array (E_NOTICE, E_USER_NOTICE, E_DEPRECATED, E_USER_DEPRECATED)))
            {
                $sLogfile = Config::get_MVC_LOG_FILE_NOTICE();
            }
        }

        $sMsg.= (self::$aExceptionTranslation[$oErrorException->getCode()] ?? 'E_???') . "\t";
        $sMsg.= '(Code: ' . $oErrorException->getCode()
                . ' / Class: ' . get_class ($oErrorException)
                . '), File: ' . $oErrorException->getFile()
                . ', Line: ' . $oErrorException->getLine()
                . ', Message: ' . $oErrorException->getMessage()
                . ', Trace: ' . $oErrorException->getTraceAsString();
        self::addERROR (
            DTArrayObject::create()
                ->add_aKeyValue(DTKeyValue::create()->set_sKey('sMessage')->set_sValue($sMsg))
                ->add_aKeyValue(DTKeyValue::create()->set_sKey('$oException')->set_sValue($oErrorException))
        );
        Log::write (
            $sMsg,
            $sLogfile,
            false
        );
    }

    /**
     * Checks for a fatal error, work around for set_error_handler not working on fatal errors.
     * @return void
     * @throws \ReflectionException
     */
    public static function fatal() : void
    {
        $aError = error_get_last ();

        if (!empty($aError))
        {
            self::error (
                $aError["message"],
                E_ERROR,
                0,
                $aError["file"],
                $aError["line"]
            );
        }
    }

    /**
     * adds an error to the error array
     * @param \MVC\DataType\DTArrayObject $oDTArrayObject
     * @return void
     * @throws \ReflectionException
     */
    protected static function addERROR(DTArrayObject $oDTArrayObject) : void
    {
        // add time
        $oDTArrayObject->add_aKeyValue(
            DTKeyValue::create()
                ->set_sKey('_sErrorTime')
                ->set_sValue((string) microtime(true))
        );
        self::$_aError[] = $oDTArrayObject;
    }

    /**
     * @param bool $bConvertToArray
     * @return array
     */
    public static function get(bool $bConvertToArray = true): array
    {
        if (true === $bConvertToArray)
        {
            return (array) Convert::objectToArray(self::$_aError);
        }

        return self::$_aError;
    }
}