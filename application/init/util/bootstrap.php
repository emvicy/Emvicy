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

//----------------------------------------------------------------------------------------------------------------------
// Environment

// Read and store .env
(false === file_exists ($sBasePath . '/.env')) ? copy($sBasePath . '/.env.example',$sBasePath . '/.env') : false;
storeEnv($sBasePath . '/.version');
storeEnv($sBasePath . '/.env');

// we need the variable MVC_ENV set. So this fallback sets it to "develop" if MVC_ENV is not already set before
(false === getenv('MVC_ENV')) ? putenv('MVC_ENV=develop') : false;
$aConfig['MVC_ENV'] = getenv('MVC_ENV');

//----------------------------------------------------------------------------------------------------------------------
// Consistency; Integrity

// check install status; if necessary, auto create folders, run composer, install required libraries
//require __DIR__ . '/checkInstall.php';

//----------------------------------------------------------------------------------------------------------------------
// Config

require $sBasePath . '/config/_mvc.php';
$aConfig = $cLoadConfigforMain($aConfig); # use Closure
$aConfig = $cLoadConfigforModule($aConfig); # use Closure

//----------------------------------------------------------------------------------------------------------------------
// Autoloader

$cAutoload($aConfig); # use Closure

//----------------------------------------------------------------------------------------------------------------------
unset($sBasePath, $cLoadConfigforMain, $cLoadConfigforModule, $cAutoload);