<?php
/**
 * Header.php
 * @package Emvicy
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <emvicy@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

namespace MVC\Http;

use MVC\Config;
use MVC\Enum\EnumHttpHeaderCacheControl;
use MVC\Enum\EnumHttpHeaderRetryAfter;
use MVC\Log;
use MVC\Request;
use MVC\RequestHelper;
use Respect\Validation\Validator;

class Header
{
    /**
     * @var null
     */
    protected static $_oInstance = null;

    /**
     * @var string[]
     */
    public static $aHttpHeaderCSPKeyMapping = array(
        // header key                   CSP config key
        'Content-Security-Policy'   => 'Content-Security-Policy',   // Default
        'X-Content-Security-Policy' => 'Content-Security-Policy',   // IE
        'X-Webkit-CSP'              => 'Content-Security-Policy',   // Chrome, Safari
        'X-Frame-Options'           => 'X-Frame-Options',
        'X-XSS-Protection'          => 'X-XSS-Protection',
        'Strict-Transport-Security' => 'Strict-Transport-Security',
    );

    /**
     * Constructor
     */
    protected function __construct()
    {
        ;
    }

    /**
     * @return self|null
     */
    public static function init()
    {
        if (null === self::$_oInstance)
        {
            self::$_oInstance = new self();
        }

        return self::$_oInstance;
    }

    /**
     * @param string $sType
     * @return $this
     */
    public function Content_Type(string $sType = '') : Header
    {
        header('Content-Type: ' . $sType);

        return $this;
    }

    /**
     * @param int $iFilesize
     * @return $this
     */
    public function Content_Length(int $iFilesize = 0) : Header
    {
        header('Content-Length: ' . $iFilesize);

        return $this;
    }

    /**
     * @param string $sFilename
     * @return $this
     */
    public function Content_Disposition_Attachment(string $sFilename = '') : Header
    {
        header('Content-Disposition: attachment; filename=' . urlencode($sFilename));

        return $this;
    }

    /**
     * @return $this
     */
    public function Content_Type_application_download() : Header
    {
        header('Content-Type: application/download');

        return $this;
    }

    /**

     * @return $this
     */
    public function Content_Type_application_force_download() : Header
    {
        header('Content-Type: application/force-download');

        return $this;
    }

    /**
     * @return $this
     */
    public function Content_Type_application_octet_stream() : Header
    {
        header('Content-Type: application/octet-stream');

        return $this;
    }

    /**
     * @return $this
     */
    public function Content_Description_File_Transfer() : Header
    {
        header('Content-Description: File Transfer');

        return $this;
    }

    /**
     * @param string $sOrigin
     * @return $this
     */
    public function Access_Control_Allow_Origin(string $sOrigin = '*') : Header
    {
        header('Access-Control-Allow-Origin: ' . $sOrigin);

        return $this;
    }

    /**
     * @param \MVC\Enum\EnumHttpHeaderCacheControl|\MVC\Enum\EnumHttpHeaderCacheControl[] $mEnumCacheControl
     * @return $this
     * @example Header::init()->Cache_Control(EnumCacheControl::NoCache);
     * *          Header::init()->Cache_Control(array(EnumCacheControl::NoCache, EnumCacheControl::MustRevalidate));
     */
    public function Cache_Control(EnumHttpHeaderCacheControl | array $mEnumCacheControl) : Header
    {
        $sCacheControl = '';

        if (true === is_array($mEnumCacheControl))
        {
            /** @var \MVC\Enum\EnumHttpHeaderCacheControl $sEnumCacheControl */
            foreach ($mEnumCacheControl as $sEnumCacheControl)
            {
                $sCacheControl.= $sEnumCacheControl->value() . ',';
            }

            $sCacheControl = substr($sCacheControl, 0, -1);
        }
        else
        {
            $sCacheControl = $mEnumCacheControl->value();
        }

        header("Cache-Control: " . trim($sCacheControl));

        return $this;
    }

    /**
     * @param string $sLocation default=''
     * @param bool   $bReplace default=true
     * @param int    $iResponseCode default=302 "Found"
     * @param bool   $bExit default=true
     * @return void
     */
    public function Location(string $sLocation = '', bool $bReplace = true, int $iResponseCode = 302, bool $bExit = true) : void
    {
        if (false === ('' === $sLocation))
        {
            header(
                'Location: ' . $sLocation,
                $bReplace,
                $iResponseCode
            );

            if (true === $bExit)
            {
                exit();
            }
        }
    }

    /**
     * @param int $iExpireSeconds any int value; positive (future) or negative (past)
     * @return $this
     * @example Header::init()->Expires(iExpireSeconds: (60 * 60 * 24)) # +1 day (future)
     *          Header::init()->Expires(iExpireSeconds: -(60 * 60 * 24)) # -1 day (past)
     */
    public function Expires(int $iExpireSeconds = 0) : Header
    {
        header('Expires: ' . gmdate('D, d M Y H:i:s \G\M\T', time() + $iExpireSeconds));

        return $this;
    }

    /**
     * @param string $sEtag
     * @return $this
     * @see https://datatracker.ietf.org/doc/html/rfc7232#section-2.3
     */
    public function Etag(string $sEtag = '""') : Header
    {
        header('Etag: ' . $sEtag);

        return $this;
    }

    /**
     * @param int $iUnixTimestamp
     * @return $this
     */
    public function Last_Modified(int $iUnixTimestamp = 0) : Header
    {
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s', $iUnixTimestamp) . ' GMT');

        return $this;
    }

    /**
     * @param string $sName
     * @param string $sValue
     * @param int    $iExpireUnixTimestamp
     * @param string $sPath
     * @param string $sDomain
     * @param string $sSameSite
     * @param bool   $bSecure
     * @param bool   $bHttpOnly
     * @return $this
     * @throws \ReflectionException
     */
    public function Set_Cookie(string $sName, string $sValue, int $iExpireUnixTimestamp = 0, string $sPath = '/', string $sDomain = '', string $sSameSite = '', bool $bSecure = false, bool $bHttpOnly = false) : Header
    {
        $sValue = rawurlencode($sValue);
        $sDate = date('D, d M Y H:i:s \G\M\T', $iExpireUnixTimestamp);
        $sHeader = 'Set-Cookie: ' . $sName . '=' . $sValue . ';';
        (true === empty($sDomain)) ? $sDomain = Request::in()->get_host() : false;

        (false === empty($iExpireUnixTimestamp))
            ? $sHeader.= 'expires=' . $sDate . '; Max-Age=' . ($iExpireUnixTimestamp - time()) . ';'
            : false;

        (false === empty($sPath))
            ? $sHeader.= 'path=' . $sPath . ';'
            : false;

        (false === empty($sDomain))
            ? $sHeader.= 'domain=' . $sDomain . ';'
            : false;

        (false === empty($sSameSite))
            ? $sHeader.= 'SameSite=' . $sSameSite . ';'
            : false;

        (true === $bSecure)
            ? $sHeader.= 'secure' . ';'
            : false;

        (true === $bHttpOnly)
            ? $sHeader.= 'HttpOnly' . ';'
            : false;

        header($sHeader, false);

        return $this;
    }

    /**
     * @param int    $iRefreshSeconds
     * @param string $sUrl
     * @return void
     */
    public function Refresh(int $iRefreshSeconds = 0, string $sUrl = '') : void
    {
        $sHeader = 'Refresh: ' . $iRefreshSeconds . ';';

        (false === empty($sUrl))
            ? $sHeader.= 'url=' . trim($sUrl)
            : false
        ;

        header($sHeader, false);
    }

    /**
     * Only the "Basic" authentication method is supported. See the header() function for more information.
     * "user" and "password" are stored in: $_SERVER['PHP_AUTH_USER'], $_SERVER['PHP_AUTH_PW']
     *
     * Be aware this is state-less.
     * And you must manage any check of `PHP_AUTH_USER` and `PHP_AUTH_PW` yourself
     *
     * @see https://www.php.net/manual/en/features.http-auth.php
     * @param string $sBasicRealm   The only reliably supported character set for this value is us-ascii
     * @return $this|void
     */
    public function WWW_Authenticate(string $sBasicRealm = 'Authentication')
    {
        if (false === Validator::alnum(' ')->validate($sBasicRealm))
        {
            return $this;
        }

        if (false === isset($_SERVER['PHP_AUTH_USER']))
        {
            Status_Unauthorized_401::header();
            /*
             * Please be careful when coding the HTTP header lines.
             * In order to guarantee maximum compatibility with all clients,
             * the keyword "Basic" should be written with an uppercase "B",
             * the realm string must be enclosed in double (not single) quotes,
             * and exactly one space should precede the 401 code in the HTTP/1.0 401 header line.
             * Authentication parameters have to be comma-separated.
             */
            header('WWW-Authenticate: Basic realm="' . $sBasicRealm . '"');

            if (true === empty($sUrlAuthFails))
            {
                echo 'Authentication required';
                exit();
            }
        }

        return $this;
    }

    /**
     * @param int                                $iValue
     * @param \MVC\Enum\EnumHttpHeaderRetryAfter $eEnumRetryAfter
     * @return $this
     */
    public function Retry_After(int $iValue = 0, EnumHttpHeaderRetryAfter $eEnumRetryAfter = EnumHttpHeaderRetryAfter::UnixTimestamp) : Header
    {
        ('UnixTimestamp' === $eEnumRetryAfter->value())
            ? header('Retry-After: ' . gmdate('D, d M Y H:i:s \G\M\T', $iValue))
            : false
        ;
        ('RetryAfterSeconds' === $eEnumRetryAfter->value())
            ? header('Retry-After: ' . gmdate('D, d M Y H:i:s \G\M\T', time() + $iValue))
            : false
        ;

        return $this;
    }

    /**
     * sets CSP ("Content Security Policy") HTTP Header
     * @param array $aCSPpublic function ContentSecurityPolicy(array $aCSP = array()) : Header
     * @return $this
     * @throws \ReflectionException
     */
    public function ContentSecurityPolicy(array $aCSP = array()) : Header
    {
        (true === empty($aCSP))
            ? $aCSP = (Config::MODULE()['CSP'] ?? array())
            : false
        ;

        foreach (self::$aHttpHeaderCSPKeyMapping as $sKey => $sValue)
        {
            if (null === ($aCSP[$sKey] ?? null))
            {
                continue;
            }

            header($sKey . ': ' . trim(preg_replace('!\s+!', ' ', $aCSP[$sKey])));
        }

        return $this;
    }

    /**
     * @param string $sStatus
     * @return $this
     */
    public function X_Accel_Buffering(string $sStatus = 'no') : Header
    {
        header('X-Accel-Buffering: ' . $sStatus);

        return $this;
    }
}