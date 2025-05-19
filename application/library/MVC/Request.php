<?php
/**
 * Request.php
 *
 * @package Emvicy
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <emvicy@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

namespace MVC;

use JetBrains\PhpStorm\NoReturn;
use MVC\DataType\DTArrayObject;
use MVC\DataType\DTKeyValue;
use MVC\DataType\DTRequestIn;
use MVC\DataType\DTRequestOut;
use MVC\DataType\DTResponse;
use MVC\Enum\EnumRequestMethod;
use MVC\Http\Status_Not_Found_404;
use WpOrg\Requests\Exception;
use WpOrg\Requests\Exception\InvalidArgument;
use WpOrg\Requests\Requests;

/**
 * Request
 */
class Request
{
    /**
     * @return \MVC\DataType\DTRequestIn
     * @throws \ReflectionException
     */
    public static function in() : DTRequestIn
    {
        // run only once at runtime
        if (true === Registry::isRegistered('oDTRequestIn'))
        {
            return Registry::get('oDTRequestIn');
        }

        $aUriInfo = parse_url(self::getTheUriProtocol() . $_SERVER['HTTP_HOST'] . self::getTheServerRequestUri());
        (false === is_array($aUriInfo)) ? $aUriInfo = array() : false;

        $oDTRequestIn = DTRequestIn::create($aUriInfo);
        $oDTRequestIn->set_requestUri(self::getTheServerRequestUri());
        $oDTRequestIn->set_protocol(self::getTheUriProtocol());

        $oDTRequestIn->set_full(self::getTheUriProtocol() . $_SERVER['HTTP_HOST'] . self::getTheServerRequestUri());
        $oDTRequestIn->set_pathArray(RequestHelper::getPathArrayOnUrl($oDTRequestIn->get_full()));

        $oDTRequestIn->set_requestMethod(self::getTheServerRequestMethod());
        $oDTRequestIn->set_input(file_get_contents("php://input"));
        $oDTRequestIn->set_isSecure(Config::get_MVC_SECURE_REQUEST());
        parse_str($oDTRequestIn->get_query(), $aQueryArray);
        $oDTRequestIn->set_queryArray($aQueryArray);
        $oDTRequestIn->set_headerArray(self::getTheHeaderArray());
        $oDTRequestIn->set_pathParamArray(self::getThePathParam());
        $oDTRequestIn->set_ip(self::getTheIpAddress());
        $oDTRequestIn->set_cookieArray($_COOKIE);
        $oDTRequestIn->set_isCli(self::itIsCli());
        $oDTRequestIn->set_isHttp(false === (false === stristr($oDTRequestIn->get_scheme(), 'http')));

        // if event ...
        Event::bind('mvc.controller.init.before', function(){
            // ... run this event
            Event::run('mvc.request.in.after', Registry::get('oDTRequestIn'));
        });

        // save to registry
        Registry::set('oDTRequestIn', $oDTRequestIn);

        return $oDTRequestIn;
    }

    /**
     * @param \MVC\DataType\DTRequestOut $oDTRequestOut
     * @return \MVC\DataType\DTResponse
     * @throws \ReflectionException
     */
    public static function out(DTRequestOut $oDTRequestOut) : DTResponse
    {
        if (true === empty($oDTRequestOut->get_sUrl()))
        {
            return DTResponse::create()
                ->set_status_code(Status_Not_Found_404::CODE)
                ->set_success(false);
        }

        // add missing if it is only local path
        $aParseUrl = parse_url($oDTRequestOut->get_sUrl());

        if (false === isset($aParseUrl['scheme']) || false === isset($aParseUrl['host']) || false === isset($aParseUrl['path']))
        {
            $sUrl = '';
            $sUrl.= (false === isset($aParseUrl['scheme'])) ? self::getTheUriProtocol() : $aParseUrl['scheme'];
            $sUrl.= (false === isset($aParseUrl['host'])) ? $_SERVER['HTTP_HOST'] : $aParseUrl['host'];
            $sUrl.= (false === isset($aParseUrl['path'])) ? '/' : $aParseUrl['path'];
            $oDTRequestOut->set_sUrl($sUrl);
        }

        Event::run('mvc.request.out.before', $oDTRequestOut);
        $oResponse = array();
        $iNow = time();

        try {

            switch ($oDTRequestOut->get_eRequestMethod()->value())
            {
                // headers, options
                case EnumRequestMethod::GET->value():
                    $oResponse = Requests::get($oDTRequestOut->get_sUrl(), $oDTRequestOut->get_aHeader(), $oDTRequestOut->get_aOption());
                    break;
                case EnumRequestMethod::DELETE->value():
                    $oResponse = Requests::delete($oDTRequestOut->get_sUrl(), $oDTRequestOut->get_aHeader(), $oDTRequestOut->get_aOption());
                    break;
                case EnumRequestMethod::TRACE->value():
                    $oResponse = Requests::trace($oDTRequestOut->get_sUrl(), $oDTRequestOut->get_aHeader(), $oDTRequestOut->get_aOption());
                    break;

                // headers, data, options
                case EnumRequestMethod::PUT->value():
                    $oResponse = Requests::put($oDTRequestOut->get_sUrl(), $oDTRequestOut->get_aHeader(), $oDTRequestOut->get_aData(), $oDTRequestOut->get_aOption());
                    break;
                case EnumRequestMethod::POST->value():
                    $oResponse = Requests::post($oDTRequestOut->get_sUrl(), $oDTRequestOut->get_aHeader(), $oDTRequestOut->get_aData(), $oDTRequestOut->get_aOption());
                    break;
                case EnumRequestMethod::PATCH->value():
                    $oResponse = Requests::patch($oDTRequestOut->get_sUrl(), $oDTRequestOut->get_aHeader(), $oDTRequestOut->get_aData(), $oDTRequestOut->get_aOption());
                    break;
                case EnumRequestMethod::OPTIONS->value():
                    $oResponse = Requests::options($oDTRequestOut->get_sUrl(), $oDTRequestOut->get_aHeader(), $oDTRequestOut->get_aData(), $oDTRequestOut->get_aOption());
                    break;
            }

            // build DTResponse object and overwrite header array with parsed from raw response
            $oDTResponse = DTResponse::create(Convert::objectToArray($oResponse))->set_headers(RequestHelper::parseRawHeader($oResponse->raw))->set_processingTime(time() - $iNow);

        } catch (InvalidArgument $oInvalidArgument) {

            Error::exception($oInvalidArgument);
            $oResponse = DTResponse::create()
                ->set_success(false)
                ->set_body($oInvalidArgument->getMessage())
            ;
            $oDTResponse = DTResponse::create(Convert::objectToArray($oResponse))->set_processingTime(time() - $iNow);

        } catch (Exception $oException) {

            Error::exception($oException);
            $oResponse = DTResponse::create()
                ->set_success(false)
                ->set_body($oException->getMessage())
            ;
            $oDTResponse = DTResponse::create(Convert::objectToArray($oResponse))->set_processingTime(time() - $iNow);

        }

        Event::run('mvc.request.out.after', $oDTResponse);

        return $oDTResponse;
    }

    #-------------------------------------------------------------------------------------------------------------------
    # private

    /**
     * gets the http uri protocol
     * @param mixed $mSsl
     * @return string
     * @throws \ReflectionException
     */
    private static function getTheUriProtocol(mixed $mSsl = null) : string
    {
        // detect on ssl or not
        if (isset($mSsl))
        {
            // http
            if ((int) $mSsl === 0 || $mSsl == false)
            {
                return 'http://';
            }
            // https
            elseif ((int) $mSsl === 1 || $mSsl == true)
            {
                return 'https://';
            }
        }
        // autodetect
        else
        {
            // http
            if (self::itIsSsl() === false)
            {
                return 'http://';
            }
            // http
            elseif (self::itIsSsl() === true)
            {
                return 'https://';
            }
        }

        Event::run('mvc.error', DTArrayObject::create()
            ->add_aKeyValue(DTKeyValue::create()
                ->set_sKey('sMessage')
                ->set_sValue('could not detect protocol of requested page.')));

        return '';
    }

    /**
     * check request is secure
     * @return bool
     * @throws \ReflectionException
     */
    private static function itIsSsl() : bool
    {
        if (!empty(Config::get_MVC_SECURE_REQUEST()))
        {
            return Config::get_MVC_SECURE_REQUEST();
        }

        return (
            (array_key_exists('HTTPS', $_SERVER) && strtolower($_SERVER['HTTPS']) !== 'off')
            || $_SERVER['SERVER_PORT'] == Config::get_MVC_SSL_PORT()
        );
    }

    /**
     * @info detection of cli takes place in /config/_mvc.php
     * @return bool
     * @throws \ReflectionException
     */
    private static function itIsCli() : bool
    {
        if (true === Config::get_MVC_CLI())
        {
            return true;
        }

        return false;
    }

    /**
     * @return string
     */
    private static function getTheServerRequestUri() : string
    {
        return (array_key_exists('REQUEST_URI', $_SERVER) ? (string) $_SERVER['REQUEST_URI'] : '');
    }

    /**
     * @return string
     */
    private static function getTheServerRequestMethod() : string
    {
        return (array_key_exists('REQUEST_METHOD', $_SERVER) ? (string) $_SERVER['REQUEST_METHOD'] : '');
    }

    /**
     * @param string $sKey
     * @return array|string
     * @throws \ReflectionException
     */
    private static function getThePathParam(string $sKey = '') : array|string
    {
        if (Registry::isRegistered('aPathParam'))
        {
            $aParam = (array) Registry::get('aPathParam');

            if ('' === $sKey)
            {
                return $aParam;
            }

            return (string) ($aParam[$sKey] ?? '');
        }

        return (empty($sKey)) ? array() : '';
    }

    /**
     * @return array
     */
    private static function getTheHeaderArray() : array
    {
        $aHeader = getallheaders();

        if (false === $aHeader)
        {
            return array();
        }

        return $aHeader;
    }

    /**
     * @return string
     */
    private static function getTheIpAddress() : string
    {
        return (string) (true === isset($_SERVER['HTTP_CLIENT_IP']))
            ? $_SERVER['HTTP_CLIENT_IP']
            : ($_SERVER['HTTP_X_FORWARDED_FOR'] ?? $_SERVER['REMOTE_ADDR'])
            ;
    }

    #-------------------------------------------------------------------------------------------------------------------
    # Emvicy1x backwards compat methods

    /**
     * @deprecated
     * @return \MVC\DataType\DTRequestIn
     * @throws \ReflectionException
     */
    public static function getCurrentRequest(): DTRequestIn
    {
        return self::in();
    }

    /**
     * @param \MVC\DataType\DTRequestIn $oDTRequestIn
     * @return void
     *@deprecated
     */
    public static function setCurrentRequest(DTRequestIn $oDTRequestIn): void
    {
        // save to registry
        Registry::set('oDTRequestIn', $oDTRequestIn);
    }

    /**
     * @deprecated
     * gets the http uri protocol
     * @param mixed $mSsl
     * @return string
     * @throws \ReflectionException
     */
    public static function getUriProtocol(mixed $mSsl = null) : string
    {
        return self::in()->get_protocol();
    }

    /**
     * @deprecated
     * check request is secure
     * @return bool
     * @throws \ReflectionException
     */
    public static function detectSsl() : bool
    {
        return self::in()->get_isSecure();
    }

    /**
     * @deprecated
     * redirects to given Location URI
     * @param string $sLocation
     * @param bool   $bReplace
     * @param int    $iResponseCode
     * @return void
     * @throws \ReflectionException
     */
    #[NoReturn]
    public static function redirect(string $sLocation = '', bool $bReplace = true, int $iResponseCode = 0) : void
    {
        RequestHelper::redirect($sLocation, $bReplace, $iResponseCode);
    }

    /**
     * @deprecated
     * @info detection of cli takes place in /config/_mvc.php
     * @return bool
     * @throws \ReflectionException
     */
    public static function isCli() : bool
    {
        return self::in()->get_isCli();
    }

    /**
     * @deprecated
     * @info detection of cli takes place in /config/_mvc.php
     * @return bool
     * @throws \ReflectionException
     */
    public static function isHttp() : bool
    {
        return self::in()->get_isHttp();
    }

    /**
     * @deprecated
     * @return string
     * @throws \ReflectionException
     */
    public static function getServerRequestUri() : string
    {
        return self::in()->get_requestUri();
    }

    /**
     * @deprecated
     * @return string
     * @throws \ReflectionException
     */
    public static function getServerRequestMethod() : string
    {
        return self::in()->get_requestMethod();
    }

    /**
     * @deprecated
     * @example '/foo/bar/baz/'
     *          array(3) {[0]=> string(3) "foo" [1]=> string(3) "bar" [2]=> string(3) "baz"}
     * @param string $sUrl
     * @param bool   $bReverse
     * @return array
     * @throws \ReflectionException
     */
    public static function getPathArray(string $sUrl = '', bool $bReverse = false) : array
    {
        return self::in()->get_pathArray();
    }

    /**
     * @deprecated
     * @param string $sKey
     * @return array|string
     * @throws \ReflectionException
     */
    public static function getPathParam(string $sKey = '') : array|string
    {
        if (false === empty($sKey))
        {
            return (self::in()->get_pathParamArray()[$sKey] ?? '');
        }

        return self::in()->get_pathParamArray();
    }

    /**
     * @deprecated
     * @param array $aPathParam
     * @return void
     * @throws \ReflectionException
     */
    public static function setPathParam(array $aPathParam = array()) : void
    {
        self::in()->set_pathParamArray($aPathParam);
    }

    /**
     * @deprecated
     * @return array
     * @throws \ReflectionException
     */
    public static function getHeaderArray() : array
    {
        return self::in()->get_headerArray();
    }

    /**
     * @deprecated
     * @param string $sKey
     * @param bool   $bCaseInsensitive
     * @return string
     * @throws \ReflectionException
     */
    public static function getHeaderValueOnKey(string $sKey = '', bool $bCaseInsensitive = true) : string
    {
        return RequestHelper::getHeaderValueOnKey($sKey, $bCaseInsensitive);
    }

    /**
     * @deprecated
     * @return string
     * @throws \ReflectionException
     */
    public static function getIpAddress() : string
    {
        return self::in()->get_ip();
    }
}