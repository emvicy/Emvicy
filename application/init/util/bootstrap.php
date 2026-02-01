<?php

/**
 * @package Emvicy
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <emvicy@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

MVC_FUNCTIONS: {

    require_once __DIR__ . '/functions.php';
}

READ_ENV: {

    $sBasePath = realpath(__DIR__ . '/../../../');
    (false === file_exists ($sBasePath . '/.env')) ? copy($sBasePath . '/.env.example',$sBasePath . '/.env') : false;

//    mvcStoreEnv($sBasePath . '/.env');
    require_once realpath(__DIR__ . '/../../') . '/library/MVC/_Init/MvcStoreEnv.php';
    \MVC\_Init\MvcStoreEnv::do($sBasePath . '/.env');
    unset($sBasePath);
}

MVC_ENV: {

    // we need the variable MVC_ENV set.
    // So this fallback sets it to "develop" if MVC_ENV is not already set before
    (false === getenv('MVC_ENV'))
        ? putenv('MVC_ENV=develop')
        : false
    ;
    $aConfig['MVC_ENV'] = getenv('MVC_ENV');
}

CONFIG: {

    require_once realpath(__DIR__ . '/../../') . '/library/MVC/_Init/MvcConfigLoader.php';
//    $aConfig = mvcConfigLoader($aConfig);
    $aConfig = \MVC\_Init\MvcConfigLoader::do($aConfig);
}

LOAD_FIRST_ESSENTIALS:{

    require_once realpath(__DIR__ . '/../../') . '/library/MVC/_Init/MvcWhereis.php';

    require_once realpath(__DIR__ . '/../../') . '/library/MVC/Config.php';
    require_once realpath(__DIR__ . '/../../') . '/library/MVC/Debug.php';
    require_once realpath(__DIR__ . '/../../') . '/library/MVC/Log.php';
    require_once realpath(__DIR__ . '/../../') . '/library/MVC/Registry.php';
}

MVC_INSTALL: {

    // check install status.
    // if necessary, auto create folders, run composer, install required libraries
    require_once __DIR__ . '/checkInstall.php';
}

MVC_AUTOLOADING: {

    // set Include paths
    set_include_path (
        get_include_path ()

        // MVC Application
        . PATH_SEPARATOR . $aConfig['MVC_LIBRARY']
        . PATH_SEPARATOR . $aConfig['MVC_MODULES_DIR']
        . PATH_SEPARATOR . implode (PATH_SEPARATOR, $aConfig['MVC_SMARTY_PLUGINS_DIR'])
    );

    // Enable Autoload for main Composer Libs
    require_once $aConfig['MVC_APPLICATION_PATH'] . '/vendor/autoload.php';

    /**
     * custom composer libraries
     * which may defined via your custom config
     * by $aConfig['MVC_COMPOSER_DIR']
     *
     * For example:
     * 		$aConfig['MVC_COMPOSER_DIR'] = $aConfig['MVC_CONFIG_DIR'];
     * 		or, even better, using a subdirectory - here, it is called "Emvicy":
     * 		$aConfig['MVC_COMPOSER_DIR'] = $aConfig['MVC_CONFIG_DIR'] . '/myMvc/';
     */
    if (isset ($aConfig['MVC_COMPOSER_DIR']) && file_exists ($aConfig['MVC_COMPOSER_DIR'] . '/vendor/autoload.php'))
    {
        require_once $aConfig['MVC_COMPOSER_DIR'] . '/vendor/autoload.php';
    }

    /**
     * PSR4 autoloader
     */
    spl_autoload_register(function ($sClassName) {

        global $aConfig;

        $sFileName = str_replace('\\', DIRECTORY_SEPARATOR, $sClassName) . '.php';

        if (true === $aConfig['MVC_LOG_AUTOLOADER'])
        {
            if (true === class_exists('\MVC\Log') && (true === class_exists('\MVC\Request')) && array_key_exists('REMOTE_ADDR', $_SERVER))
            {
                \MVC\Log::write('AUTOLOADING' . "\t" . $sFileName);
            }
        }

        require_once $sFileName;
    });
}