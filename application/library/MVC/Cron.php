<?php

namespace MVC;


use Symfony\Component\Yaml\Yaml;

class Cron
{
    /**
     * @var \MVC\Cron
     */
    protected static $_oInstance = null;

    /**
     * @var string
     */
    protected $sCronYamlFile = '';

    /**
     * @var string
     */
    protected $sCacheToken = 'mvccrnrn';

    /**
     * Constructor
     */
    protected function __construct(string $sCronYamlFile = '')
    {
        $this->sCronYamlFile = $sCronYamlFile;
    }

    /**
     * @param string $sCronYamlFile
     * @return \MVC\Cron
     */
    public static function init(string $sCronYamlFile = '') : \MVC\Cron
    {
        if (null === self::$_oInstance)
        {
            self::$_oInstance = new self($sCronYamlFile);
        }

        return self::$_oInstance;
    }

    public function run()
    {
        if (false === file_exists($this->sCronYamlFile))
        {
            Error::error('file does not exist: `' . $this->sCronYamlFile . '`');

            return false;
        }

//        \register_shutdown_function(function (){
//            echo "register_shutdown_function()\n";
//        });

//        // delete caches explicitly at startup
//        $aLockCache = glob(Config::get_MVC_CACHE_DIR() . '/' . $sLockCacheToken . '[!.,!..]*');
//        (false === empty($aLockCache)) ? array_map('rmdir', $aLockCache) : false;
//        Cache::autoDeleteCache($sMd5Cache, 0);

        // lock on runtime
        \MVC\Lock::create($this->sCacheToken);

        // initial read
//        $aCron = Yaml::parseFile($this->sCronYamlFile);

        while (true)
        {
            if (false === file_exists($this->sCronYamlFile))
            {
                Error::error('file does not exist: `' . $this->sCronYamlFile . '`');
                break;
            }

            $sMd5OfFile = md5_file($this->sCronYamlFile);

            if (Cache::getCache($this->sCacheToken) !== $sMd5OfFile)
            {
                echo "*** UPDATE ***\n";
                $aCron = Yaml::parseFile($this->sCronYamlFile);
                Cache::saveCache($this->sCacheToken, $sMd5OfFile);
            }

            echo $sMd5OfFile . "\t" . Cache::getCache($this->sCacheToken) . "\t" . json_encode($aCron) . "\n";
//            foreach ($aCronJob as $sRoute => $iIntervall)
//            {
//                \Cdm\Model\Worker::run($sRoute, $iIntervall);
//            }
//
//            ('' !== session_id()) ? \Cdm\Model\Worker::deleteSessionFile(session_id()) : false;
            sleep(1);
        }
    }

    protected function fileExists()
    {
        if (false === file_exists($this->sCronYamlFile))
        {
            Error::error('file does not exist: `' . $this->sCronYamlFile . '`');

            return false;
        }
    }

    public function __destruct()
    {
        echo "\nScript executed with success" . "\n\n";

//        // delete caches explicitly
//        $aLockCache = glob(Config::get_MVC_CACHE_DIR() . '/' . $this->sCacheToken . '[!.,!..]*');
//        (false === empty($aLockCache)) ? array_map('rmdir', $aLockCache) : false;
//        Cache::autoDeleteCache($this->sCacheToken, 0);
    }
}
