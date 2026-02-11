<?php

/**
 * @package Emvicy
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <emvicy@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

$sBasePath = realpath(__DIR__ . '/../../../');

//----------------------------------------------------------------------------------------------------------------------
// Functions

require __DIR__ . '/functions.php';
require $sBasePath . '/application/library/MVC/_Init/MvcStoreEnv.php';
require $sBasePath . '/application/library/MVC/_Init/MvcConfig.php';

//----------------------------------------------------------------------------------------------------------------------
// Environment

// Read and store .env
(false === file_exists ($sBasePath . '/.env')) ? copy($sBasePath . '/.env.example',$sBasePath . '/.env') : false;
\MVC\_Init\MvcStoreEnv::do($sBasePath . '/.env');

// we need the variable MVC_ENV set. So this fallback sets it to "develop" if MVC_ENV is not already set before
(false === getenv('MVC_ENV')) ? putenv('MVC_ENV=develop') : false;
$aConfig['MVC_ENV'] = getenv('MVC_ENV');

//----------------------------------------------------------------------------------------------------------------------
// Completeness

// check install status.
// if necessary, auto create folders, run composer, install required libraries
//require __DIR__ . '/checkInstall.php';

//----------------------------------------------------------------------------------------------------------------------
// Config

require $sBasePath . '/config/_mvc.php';
$aConfig = \MVC\_Init\MvcConfig::main($aConfig);
$aConfig = \MVC\_Init\MvcConfig::module($aConfig);

//----------------------------------------------------------------------------------------------------------------------
// Autoloader

require $sBasePath . '/application/vendor/autoload.php';
\MVC\_Init\MvcConfig::autoload($aConfig);

//----------------------------------------------------------------------------------------------------------------------
unset($sBasePath);