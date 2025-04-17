<?php

/**
 * @package Emvicy
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <info@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */
// bootstrap
//if (true === file_exists(realpath(__DIR__ . '/../') . '/application/persistent/'))
//{
//    require_once '../application/init/util/bootstrap2.php';
//    // run
//    $oMVCApplication = new \MVC\Application(bInit: false);
//}
//else
//{
    require_once '../application/init/util/bootstrap.php';
    // run
    $oMVCApplication = new \MVC\Application();
//}


