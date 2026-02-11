<?php

namespace MVC\_Init;

use MVC\Log;

class MvcConfig
{
    /**
     * @param array $aConfig
     * @return array|void
     */
    public static function main(array $aConfig = array())
    {
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

        // load requirements from /application/init/util/_mvc.php
        require_once $aConfig['MVC_APPLICATION_INIT_DIR'] . '/util/_mvc.php';

        return $aConfig;
    }

    /**
     * @param $aConfig
     * @return void
     */
    public static function createKonfigClass($aConfig)
    {
        // statics
        $sClassName = 'Konfig';
        $sFilenameAbs = $aConfig['MVC_APPLICATION_PATH'] . '/persist/' . $sClassName . '.php';
        $sFileContent = '';
        $sFileContent.= "<?php\n\n";
        $sFileContent.="namespace MVC;\n\n";
        $sFileContent.= "class " . $sClassName . " extends \MVC\KonfigBase\n{\n";
        $sFileContent.="\tpublic const timestamp = '" . time() . "'; # timestamp of creation; " . date('Y-m-d H:i:s') . "\n\n";

        // const
        foreach ($aConfig as $sKey => $mValue)
        {
            if (stristr(\MVC\Convert::serialize($mValue),'\Closure'))
            {
                $mValue = "'" . base64_encode(\MVC\Convert::serialize($mValue)) . "'";
                $sFileContent.= "\tprotected const " . $sKey . ' = ' . $mValue . ';' . "\n";
            }
            else
            {
                $mValue = var_export($mValue, true);
                $sFileContent.= "\tpublic const " . $sKey . ' = ' . $mValue . ';' . "\n";
            }
        }

        // getter
        foreach ($aConfig as $sKey => $mValue)
        {
            if (stristr(\MVC\Convert::serialize($mValue),'\Closure'))
            {
                $sFileContent.= "\tpublic static function get_" . $sKey . "()\n";
                $sFileContent.= "\t{\n";
                $sFileContent.= "\t\treturn \MVC\Convert::unserialize(base64_decode(self::" . $sKey . "));\n";
                $sFileContent.= "\t}\n";
            }
        }

        $sFileContent.= "\n}";
        file_put_contents($sFilenameAbs, $sFileContent);
    }

    /**
     * @param array $aConfig
     * @return array
     */
    public static function module(array $aConfig)
    {
        // Modules
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

        return $aConfig;
    }

    /**
     * @return void
     * @throws \ReflectionException
     */
    public static function autoload(array $aConfig)
    {
        // set Include paths
        set_include_path (
            get_include_path ()

            // MVC Application
            . PATH_SEPARATOR . $aConfig['MVC_PERSIST']
            . PATH_SEPARATOR . $aConfig['MVC_LIBRARY']
            . PATH_SEPARATOR . $aConfig['MVC_MODULES_DIR']
            . PATH_SEPARATOR . implode (PATH_SEPARATOR, $aConfig['MVC_SMARTY_PLUGINS_DIR'])
        );

        // PSR4 autoloader
        spl_autoload_register(function ($sClassName) {

            $sFileName = str_replace('\\', DIRECTORY_SEPARATOR, $sClassName) . '.php';

            if (true === ($aConfig['MVC_LOG_AUTOLOADER'] ?? false))
            {
                if (true === class_exists('\MVC\Log') && (true === class_exists('\MVC\Request')) && array_key_exists('REMOTE_ADDR', $_SERVER))
                {
                    Log::write('AUTOLOADING' . "\t" . $sFileName);
                }
            }

            require_once $sFileName;
        });
    }
}
