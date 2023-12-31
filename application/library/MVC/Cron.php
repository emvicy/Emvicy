<?php

namespace MVC;


use Emvicy\Emvicy;
use MVC\DataType\DTCronTask;
use Symfony\Component\Yaml\Yaml;

#[experimental]
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
    protected $sCacheToken = 'mvccrnrn'; # mvc cron run

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
    public static function create(string $sCronYamlFile = '') : \MVC\Cron
    {
        if (null === self::$_oInstance)
        {
            self::$_oInstance = new self($sCronYamlFile);
        }

        return self::$_oInstance;
    }

    /**
     * @param string $sCommand
     * @return $this
     * @throws \ReflectionException
     */
    public function emvicy(string $sCommand = '')
    {
        $sCmd = 'cd ' . Config::get_MVC_BASE_PATH() . '; ' . Config::get_MVC_BIN_PHP_BINARY() . ' emvicy ' . $sCommand;
        Emvicy::shellExecute($sCmd, true);

        return $this;
    }

    /**
     * @example Cron::create()->call(function(){...});
     *          Cron::create()->call(new ModelXy());
     * @return $this
     */
    public function call()
    {
        return $this;
    }

    /**
     * @return $this
     * @throws \ReflectionException
     */
    public function routeIntervall()
    {
        $this->run('routeIntervall');

        return $this;
    }

    /**
     * @return false|void
     * @throws \ReflectionException
     */
    protected function run(string $sAction = 'routeIntervall')
    {
        if (false === file_exists($this->sCronYamlFile))
        {
            Error::error('file does not exist: `' . $this->sCronYamlFile . '`');

            return false;
        }

        // delete caches explicitly
        Cache::autoDeleteCache($this->sCacheToken, 0);

        // lock on runtime
        \MVC\Lock::create($this->sCacheToken);

        while (true)
        {
            if (false === file_exists($this->sCronYamlFile))
            {
                Error::error('file does not exist: `' . $this->sCronYamlFile . '`');
                break;
            }

            Log::$iCount = 0;

            $sMd5OfFile = md5_file($this->sCronYamlFile);

            // content of file has changed (or is new to this process)
            if (Cache::getCache($this->sCacheToken) !== $sMd5OfFile)
            {
                $aCron = Yaml::parseFile($this->sCronYamlFile);
                Cache::saveCache($this->sCacheToken, $sMd5OfFile);
            }

            switch ($sAction) {
                case 'routeIntervall':
                    foreach ($aCron as $sRoute => $iIntervall)
                    {
                        $this->execute_routeIntervall(
                            DTCronTask::create()
                                ->set_sRoute($sRoute)
                                ->set_iIntervall($iIntervall)
                        );
                    }
                    break;
            }

            ('' !== session_id()) ? Session::deleteSessionFile(session_id()): false;
        }
    }

    /**
     * @param \MVC\DataType\DTCronTask $oDTCronTask
     * @return bool
     * @throws \ReflectionException
     */
    protected function execute_routeIntervall(DTCronTask $oDTCronTask) : bool
    {
        Event::run('mvc.cron.executeTask.before', $oDTCronTask);

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

            Event::run('mvc.cron.executeTask.after', $oDTCronTask);

            Cache::saveCache(
                $sCacheKey,
                $oDTCronTask->get_sCommand()
            );
        }
        else
        {
            /** @warning Be careful if listening to this; it would mean a huge amount of continuous data flow */
            Event::run('mvc.cron.executeTask.skip', $oDTCronTask);
        }

        return true;
    }

    public function __destruct()
    {
        echo "\nScript executed with success" . "\n\n";

        // delete caches explicitly
        Cache::autoDeleteCache($this->sCacheToken, 0);
    }
}
