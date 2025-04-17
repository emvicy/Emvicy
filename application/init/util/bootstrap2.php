<?php

// Minimal Autoloader
set_include_path (get_include_path () . PATH_SEPARATOR . realpath(__DIR__ . '/../../') . '/library' . PATH_SEPARATOR . realpath(__DIR__ . '/../../../') . '/modules');
spl_autoload_register(function ($sClassName) {require_once str_replace('\\', DIRECTORY_SEPARATOR, $sClassName) . '.php';});

require_once realpath(__DIR__ . '/../../') . '/vendor/autoload.php';
require_once __DIR__ . '/functions.php';

# foo function
require_once realpath(__DIR__ . '/../../../') . '/modules/Foo/etc/config/Foo/config/_function.php';


use function Opis\Closure\{serialize, unserialize};

READ_ENV: {

    $sBasePath = realpath(__DIR__ . '/../../../');
    (false === file_exists ($sBasePath . '/.env')) ? copy($sBasePath . '/.env.example',$sBasePath . '/.env') : false;
    mvcStoreEnv($sBasePath . '/.env');
    unset($sBasePath);
}

#-----------------------------------------------------------------------------------------------------------------------

$sPersistDir = realpath(__DIR__ . '/../../') . '/persistent/';

// aConfig
$GLOBALS['aConfig'] = unserialize(file_get_contents($sPersistDir . 'aConfig.txt'));

// aRegistry
\MVC\Registry::setStorageArray(unserialize(file_get_contents($sPersistDir . 'aRegistry.txt')));

// aEvent
\MVC\Event::$aEvent = unserialize(file_get_contents($sPersistDir . 'aEvent.txt'));

// aPolicy
//$aPolicy = unserialize(file_get_contents($sPersistDir . 'aPolicy.txt'));

// aRoute
$aRoute = unserialize(file_get_contents($sPersistDir . 'aRoute.txt'));
\MVC\Route::$aRoute = $aRoute['aRoute'];
\MVC\Route::$aMethod = $aRoute['aMethod'];
\MVC\Route::$aMethodRoute = $aRoute['aMethodRoute'];

//die("die at: " . __FILE__ . ', ' . __LINE__ . "\n<hr>");

#-----------------------------------------------------------------------------------------------------------------------
