<?php
/**
 * Env.php
 * @package   Emvicy
 * @copyright ueffing.net
 * @author    Guido K.B.W. Üffing <emvicy@ueffing.net>
 * @license   GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

namespace MVC;


class Env
{
    /**
     * writes to .env file
     * @param string      $sKey
     * @param string|null $sValue
     * @param string      $sPathEnv
     * @return bool
     * @throws \ReflectionException
     */
    public static function write(string $sKey, ?string $sValue, string $sPathEnv = '')
    {
        $bPut = false;
        $sPathEnv = self::getEnvFileAbsPath($sPathEnv);

        // skip
        if (false === (false === getenv($sKey)) && true === ($sValue === getenv($sKey)))
        {
            $bPut = true;
        }
        // update existing
        elseif (false === (false === getenv($sKey)) && false === ($sValue === getenv($sKey)))
        {
            $bPut = (bool)file_put_contents($sPathEnv, str_replace(search: $sKey . '=' . getenv($sKey), replace: $sKey . '=' . $sValue, subject: trim(file_get_contents($sPathEnv))));
        }
        // add for new
        elseif (true === (false === getenv($sKey)))
        {
            $bPut = (bool)file_put_contents(filename: $sPathEnv, data: trim(file_get_contents($sPathEnv)) . "\n" . $sKey . '=' . $sValue . "\n");
        }

        if (false === $bPut)
        {
            Error::error('writing to .env file failed');
        }

        return (bool)$bPut;
    }

    /**
     * reads environment key/values from a given file
     * and stores them via putenv so that they will be accessible via getenv()
     * returns an array of environment key/values
     * @param string $sPathEnv
     * @return array
     * @throws \ReflectionException
     */
    public static function store(string $sPathEnv = '')
    {
        $aEnvContent = self::getKeyValueArray($sPathEnv);

        foreach ($aEnvContent as $sKey => $sValue)
        {
            putenv($sKey . '=' . trim($sValue));
        }

        return $aEnvContent;
    }

    /**
     * returns an array of environment key/values
     * @param string $sPathEnv
     * @return array
     * @throws \ReflectionException
     */
    public static function getKeyValueArray(string $sPathEnv = '')
    {
        $sPathEnv = self::getEnvFileAbsPath($sPathEnv);
        $aEnvContent = array_values(
            array_filter(
                array: file($sPathEnv),
                callback: 'trim'
            )
        );
        $aEnvContent = array_filter(
            $aEnvContent,
            function ($mValue) {
                return (false === (0 === strpos($mValue, '#')));
            }
        );
        $sEnvContent = implode('', $aEnvContent);

        return (array) parse_ini_string($sEnvContent);
    }

    /**
     * @param string $sPathEnv
     * @param bool   $bMustExist
     * @return string
     * @throws \ReflectionException
     */
    protected static function getEnvFileAbsPath(string $sPathEnv = '', bool $bMustExist = true)
    {
        (true === empty($sPathEnv))
            ? $sPathEnv = realpath(__DIR__ . '/../../../') . '/.env'
            : false;

        if (true === $bMustExist)
        {
            self::mustExist($sPathEnv);
        }

        return $sPathEnv;
    }

    /**
     * @param string $sPathEnv
     * @return void
     * @throws \ReflectionException
     */
    protected static function mustExist(string $sPathEnv)
    {
        if (false === file_exists($sPathEnv))
        {
            $sMessage = 'File not found: ' . $sPathEnv . "\n\n";
            Error::error($sMessage);
            echo(('cli' != php_sapi_name())
                ? nl2br($sMessage)
                : $sMessage . "\n");
            (false === getenv('emvicy'))
                ? exit()
                : false;
        }
    }
}