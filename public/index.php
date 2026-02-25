<?php

/**
 * @package Emvicy
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <info@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */
define('MVC_START_MICROTIME', microtime(true));
require '../application/init/util/bootstrap.php';
new \MVC\Application();

display(
    round((microtime(true) - MVC_START_MICROTIME), 3)
);
