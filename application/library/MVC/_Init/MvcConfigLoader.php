<?php

namespace MVC\_Init;

use MVC\Convert;

class MvcConfigLoader
{
    public static function do(array $aConfig = array())
    {
//        if (true === file_exists($aConfig['MVC_CACHE_DIR'] . '/config.json'))
//        {
//            return self::getFromCache($aConfig);
//        }

//        #-----------------------------
//        # main config
//
//        // place of main Emvicy config
//        $aConfig['MVC_CONFIG_DIR'] = realpath(__DIR__ . '/../../../../') . '/config';
//
//        // load main config from /config/*.php
//        foreach (glob ($aConfig['MVC_CONFIG_DIR'] . '/*.php') as $sFile)
//        {
//            require_once $sFile;
//            $sFile = null;
//            unset ($sFile);
//        }

//        self::createConfigClass($aConfig);

        #-----------------------------
        # module config

        if (count($aConfig['MVC_MODULE_PRIMARY']) > 1)
        {
            $sMessage = '<div class="alert alert-danger" role="alert"><center>'
                        . "<h1>⚠️</h1><p><b>There is more than one primary module, <br>but you can only have one. <br><br>Detected primary modules: <br><pre>'" . implode("','", $aConfig['MVC_MODULE_PRIMARY']) . "'</pre>\n\n"
                        . '- EOM -</b></p></center></div>';
            echo (true === $aConfig['MVC_CLI']) ? strip_tags($sMessage) : $sMessage;
            exit(1);
        }

        $aConfig['MVC_MODULE_SECONDARY'] = array_diff(array_filter(array_map(function ($sValue) use ($aConfig){
            return str_replace($aConfig['MVC_MODULES_DIR'] . '/', '', $sValue);
        }, glob($aConfig['MVC_MODULES_DIR'] . '/*', GLOB_ONLYDIR)), 'trim'), $aConfig['MVC_MODULE_PRIMARY']);

        $aConfig['MVC_MODULE_SET'] = array(
            'SECONDARY' => $aConfig['MVC_MODULE_SECONDARY'],    # handle 'SECONDARY' first
            'PRIMARY' => $aConfig['MVC_MODULE_PRIMARY'],        # handle 'PRIMARY' second
        );

        foreach ($aConfig['MVC_MODULE_SET'] as $sType => $aModule)
        {
            // walk modules
            foreach ($aModule as $sModule)
            {
                if (file_exists($aConfig['MVC_MODULES_DIR'] . '/' . $sModule . '/etc/config/'))
                {
                    // load common config files
                    foreach (glob ($aConfig['MVC_MODULES_DIR'] . '/' . $sModule . '/etc/config/*.php') as $sFile)
                    {
                        require_once $sFile;
                    }

                    // load staging config
                    $sConfigFileName =
                        $aConfig['MVC_MODULES_DIR'] . '/' . $sModule
                        . '/etc/config/'
                        . basename($sModule)
                        . '/config/'
                        . getenv('MVC_ENV')
                        . '.php';

                    if (file_exists($sConfigFileName))
                    {
                        include_once $sConfigFileName;
                    }

                    // External composer Libraries
                    $sVendorAutoload = $aConfig['MVC_MODULES_DIR'] . '/' . $sModule . '/etc/config/' . basename($sModule) . '/vendor/autoload.php';

                    if (file_exists($sVendorAutoload))
                    {
                        require_once $sVendorAutoload;
                    }
                }
            }
        }

        #-----------------------------

        // load requirements from /application/init/util/_mvc.php
        require_once $aConfig['MVC_APPLICATION_INIT_DIR'] . '/util/_mvc.php';

//        // save to cache
//        if (false === file_exists($aConfig['MVC_CACHE_DIR'] . '/config.json'))
//        {
//            self::saveToCache($aConfig);
//        }

        return $aConfig;
    }

    /**
     * @param array $aConfig
     * @return mixed
     */
    protected static function getFromCache(array $aConfig)
    {
        require_once realpath(__DIR__ . '/../') . '/Convert.php';
        $aConfig = Convert::unserialize(file_get_contents($aConfig['MVC_CACHE_DIR'] . '/config.json'));

        return $aConfig;
    }

    /**
     * @param $aConfig
     * @return bool success
     */
    protected static function saveToCache($aConfig)
    {
        require_once realpath(__DIR__ . '/../') . '/Convert.php';
        return (bool) file_put_contents($aConfig['MVC_CACHE_DIR'] . '/config.json', Convert::serialize($aConfig));
    }

    protected static function createConfigClass(array $aConfig)
    {
        // statics
        $sClassName = 'Konfig';
        $sFilenameAbs = $aConfig['MVC_LIBRARY'] . '/MVC/' . $sClassName . '.php';
        $sFileContent = '';
        $sFileContent.= "<?php\n\n";
        $sFileContent.="namespace MVC;\n\n";
        $sFileContent.= "class " . $sClassName . "\n{\n\n";

        foreach ($aConfig as $sKey => $mValue)
        {
//            $sFileContent.= "\tpublic static $" . $sKey . ' = ' . var_export($mValue, true) . ';' . "\n";
            $sFileContent.= "\tpublic const " . $sKey . ' = ' . var_export($mValue, true) . ';' . "\n";
        }

        $sFileContent.= "\n}";
        file_put_contents($sFilenameAbs, $sFileContent);

        stop();
    }
}
