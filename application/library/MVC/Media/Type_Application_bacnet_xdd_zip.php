<?php
/**
 * Type_Application_bacnet_xdd_zip.php
 * @package Emvicy
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <emvicy@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

namespace MVC\Media;

use MVC\MVCTrait\TraitMediaType;

class Type_Application_bacnet_xdd_zip
{
    use TraitMediaType;

    /**
     * @reference [ASHRAE]; [Dave_Robin]
     */
    const DESCRIPTION = 'application/bacnet-xdd+zip';
}