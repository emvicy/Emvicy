<?php

namespace MVC;


use Emvicy\Emvicy;
use MVC\DataType\DTCronTask;
use Symfony\Component\Yaml\Yaml;

class RouteIntervall
{
    /**
     * @var \MVC\RouteIntervall
     */
    protected static $_oInstance = null;

    /**
     * @var string
     */
    protected $sIntervallYamlFile = '';

    /**
     * @var string
     */
    protected $sCacheToken = 'mvcrtntrvll'; # mvc route intervall

    /**
     * @var int
     */
    protected $iPidParent;

    /**
     * @var string
     */
    protected $iPidParentFile = '';

    /**
     * Constructor
     */
    protected function __construct(string $sCronYamlFile = '')
    {
        $this->sIntervallYamlFile = $sCronYamlFile;
    }

    /**
     * @param string $sCronYamlFile
     * @return \MVC\RouteIntervall
     */
    public static function create(string $sCronYamlFile = '') : \MVC\RouteIntervall
    {
        if (null === self::$_oInstance)
        {
            self::$_oInstance = new self($sCronYamlFile);
        }

        return self::$_oInstance;
    }

    /**
     * @return false|void
     * @throws \ReflectionException
     */
    public function run()
    {
        if (false === file_exists($this->sIntervallYamlFile))
        {
            Error::error('file does not exist: `' . $this->sIntervallYamlFile . '`');

            return false;
        }

        // delete related cache explicitly
        Cache::autoDeleteCache($this->sCacheToken, 0);

        // lock on runtime
        \MVC\Lock::create($this->sCacheToken);

        Event::run('mvc.routeintervall.run.before', $this->sIntervallYamlFile);

        $this->iPidParent = getmypid();
        $this->iPidParentFile = Config::get_MVC_BASE_PATH() . '/.' . Strings::seofy(__METHOD__) . '.' . $this->iPidParent;
        touch($this->iPidParentFile);
        \register_shutdown_function('\MVC\RouteIntervall::shutdown');

        while (true)
        {
            // prevent log count exceeding
            Log::$iCount = 0;

            if (false === file_exists($this->sIntervallYamlFile))
            {
                Error::error('file does not exist: `' . $this->sIntervallYamlFile . '`');
                break;
            }

            // stop further execution if pidfile does not exist anymore
            if (false === file_exists($this->iPidParentFile))
            {
                break;
            }

            $sMd5OfFile = md5_file($this->sIntervallYamlFile);

            // content of file has changed (or is new to this process)
            if (Cache::getCache($this->sCacheToken) !== $sMd5OfFile)
            {
                $aRouteIntervall = Yaml::parseFile($this->sIntervallYamlFile);
                Cache::saveCache($this->sCacheToken, $sMd5OfFile);
            }

            // iterate intervalls
            foreach ($aRouteIntervall as $sRoute => $iIntervall)
            {
                $this->intervall(
                    DTCronTask::create()
                        ->set_sRoute($sRoute)
                        ->set_iIntervall($iIntervall)
                );
            }

            ('' !== session_id()) ? Session::deleteSessionFile(session_id()): false;
        }
    }

    /**
     * @param \MVC\DataType\DTCronTask $oDTCronTask
     * @return bool
     * @throws \ReflectionException
     */
    protected function intervall(DTCronTask $oDTCronTask) : bool
    {
        Event::run('mvc.routeintervall.intervall.before', $oDTCronTask);

        if (true === empty($oDTCronTask->get_sRoute()))
        {
            return false;
        }

        // minimum is 1 Second for intervall
        ($oDTCronTask->get_iIntervall() <= 1) ? $oDTCronTask->set_iIntervall(1) : false;
        (true === empty($oDTCronTask->get_sStaging())) ? $oDTCronTask->set_sStaging(\MVC\Config::get_MVC_ENV()) : false;

        // cli command
        $oDTCronTask->set_sCommand('cd ' . \MVC\Config::get_MVC_PUBLIC_PATH() . '; '
                                   . 'export MVC_ENV="' . $oDTCronTask->get_sStaging() . '"; '
                                   . \MVC\Config::get_MVC_BIN_PHP_BINARY() . ' index.php ' . $oDTCronTask->get_sRoute()
                                   . ' > /dev/null 2>/dev/null & echo $!');
        $sCacheKey = $this->sCacheToken . '.' . md5($oDTCronTask->getPropertyJson() . $oDTCronTask->get_sCommand()) . '.' . Strings::seofy($oDTCronTask->get_sRoute());
        $sCacheFilename = Config::get_MVC_CACHE_DIR() . '/' . $sCacheKey;

        $iFilemTime = (file_exists($sCacheFilename)) ? (int) filemtime($sCacheFilename) : 0;     // 0 at 1. run
        $iTimeAgo = (time() - $oDTCronTask->get_iIntervall());                                  // now - x Sec

        if ($iFilemTime < $iTimeAgo)
        {
            $iPid = Emvicy::shellExecute(
                $oDTCronTask->get_sCommand()
            );
            $oDTCronTask->set_iPid($iPid);

            Event::run('mvc.routeintervall.intervall.after', $oDTCronTask);

            Cache::saveCache(
                $sCacheKey,
                $oDTCronTask->get_sCommand()
            );
        }
        else
        {
            /** @warning Be careful if listening to this; it would mean a huge amount of continuous data flow */
            Event::run('mvc.routeintervall.intervall.skip', $oDTCronTask);
        }

        return true;
    }

    /**
     * @return void
     * @throws \ReflectionException
     */
    protected function shutdown()
    {
        unlink($this->iPidParentFile);

        Event::run('mvc.routeintervall.intervall.end', $this->sIntervallYamlFile);

        // delete caches explicitly
        Cache::autoDeleteCache($this->sCacheToken, 0);
    }
}
