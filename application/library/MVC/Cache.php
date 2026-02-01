<?php
/**
 * Cache.php
 *
 * @package Emvicy
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <emvicy@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

namespace MVC;

use Attribute;

#[Attribute]
class Cache
{
    /**
     * caching true/false; default=true
     * @access public
     * @static
     * @var bool|null
     */
    public static ?bool $bCaching = null;

    /**
     * delete cache files when this value is reached
     * @access public
     * @static
     * @var int|null
     */
    public static ?int $iDeleteAfterMinutes = null;

    /**
     * absolute path to cache dir
     * @access public
     * @static
     * @var string|null
     */
    public static ?string $sCacheDir = null;

    /**
     * linux binary `rm'
     * @access public
     * @static
     * @var string
     */
    public static string $sBinRemove;

    /**
     * linux binary `find'
     * @access public
     * @static
     * @var string
     */
    public static string $sBinFind;

    /**
     * linux binary `grep'
     * @access public
     * @static
     * @var string
     */
    public static string $sBinGrep;

    /**
     * sets configuration; if none is given by param, defaults are set
     * @access public
     * @static
     * @param array $aCacheConfig array(
     *		'bCaching' => true,
     *		'sCacheDir' => '/tmp/',
     *		'iDeleteAfterMinutes' => 1440
     * )
     * @throws \ReflectionException
     */
    public static function init(array $aCacheConfig = array()): void
    {
        if (true === empty($aCacheConfig))
        {
            $aCacheConfig = Config::get_MVC_CACHE_CONFIG();
        }

        (is_null(self::$bCaching)) ? (self::$bCaching						= (isset($aCacheConfig['bCaching']))			? $aCacheConfig['bCaching']				: true)					: false;
        (is_null(self::$sCacheDir)) ? (self::$sCacheDir						= (isset($aCacheConfig['sCacheDir']))			? $aCacheConfig['sCacheDir']			: sys_get_temp_dir())	: false;
        (is_null(self::$iDeleteAfterMinutes)) ? (self::$iDeleteAfterMinutes	= (isset($aCacheConfig['iDeleteAfterMinutes']))	? $aCacheConfig['iDeleteAfterMinutes']	: 1440)					: false;	// 1440min === 1 day

        self::$sBinRemove = Config::get_MVC_BIN_REMOVE();
        self::$sBinFind = Config::get_MVC_BIN_FIND();
        self::$sBinGrep = Config::get_MVC_BIN_GREP();
    }

    /**
     * gets data from cache by key
     * @param string $sKey
     * @return mixed|string
     * @throws \ReflectionException
     */
    public static function getCache(string $sKey = ''): mixed
    {
        self::init();

        if (false === self::$bCaching || '' === $sKey)
        {
            return '';
        }

        $sFilename = self::$sCacheDir . '/' . $sKey;
        $sContent = '';

        if (file_exists($sFilename))
        {
            $sContent = Convert::unserialize(
                base64_decode(
                    file_get_contents($sFilename)
                )
            );
        }

        return $sContent;
    }

    /**
     * checks whether a cache related to a given token/key exists
     * @param string $sKey
     * @return bool
     * @throws \ReflectionException
     */
    public static function exists(string $sKey = ''): bool
    {
        self::init();

        if (false === self::$bCaching || '' === $sKey)
        {
            return false;
        }

        $sFilename = self::$sCacheDir . '/' . $sKey;

        return file_exists($sFilename);
    }

    /**
     * saves data into cache on key
     * @param string $sKey
     * @param        $mData
     * @return bool
     * @throws \ReflectionException
     */
    public static function saveCache(string $sKey, $mData) : bool
    {
        self::init();

        if (false === self::$bCaching)
        {
            return false;
        }

        $sFilename = self::$sCacheDir . '/' . $sKey;
        $mData = base64_encode(
            Convert::serialize($mData)
        );

        if (!is_dir ($sFilename))
        {
            (is_file($sFilename) && file_exists($sFilename)) ? unlink($sFilename) : false;

            if (false === file_put_contents($sFilename, $mData, LOCK_EX))
            {
                return false;
            }
        }

        return true;
    }

    /**
     * deletes cachefiles after certain time
     * @require Linux commands `rm`, `find` and `grep` executable via shell_exec
     * @param string      $sToken optional; default='' (all cachefiles)
     * @param string|null $sMinutes optional; default=self::$iDeleteAfterMinutes
     * @return bool
     * @throws \ReflectionException
     */
    public static function autoDeleteCache(string $sToken = '', ?string $sMinutes = null) : bool
    {
        self::init();

        if (false === self::$bCaching)
        {
            return false;
        }

        if (null === $sMinutes)
        {
            $sMinutes = self::$iDeleteAfterMinutes;
        }

        $sCmd = self::$sBinFind . ' ' . self::$sCacheDir . ' -type f -mmin +' . $sMinutes;
        ('' !== $sToken) ? $sCmd.= ' | ' . self::$sBinGrep . ' ' . escapeshellarg(addslashes($sToken)) : false;
        $mFind = trim((string) shell_exec($sCmd));

        if (!is_null($mFind) && !empty($mFind))
        {
            $aLine = explode("\n", $mFind);
            $mRemove = false;

            foreach ($aLine as $sLine)
            {
                $sCmd = self::$sBinRemove . ' "' . $sLine . '"';
                $mRemove = shell_exec($sCmd);
            }

            return (bool) $mRemove;
        }

        return (bool) $mFind;
    }

    /**
     * flushes cache (deletes all cachefiles immediatly)
     * @require Linux command `rm` executable via shell_exec
     * @return bool
     * @throws \ReflectionException
     */
    public static function flushCache() : bool
    {
        self::init();

        if (false === self::$bCaching)
        {
            return false;
        }

        $sCmd = self::$sBinRemove . ' -rf ' . self::$sCacheDir . '/*';
        $mResult = shell_exec($sCmd);

        return (bool) $mResult;
    }
}
