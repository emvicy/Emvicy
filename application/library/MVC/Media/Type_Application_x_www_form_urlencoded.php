<?php
/**
 * Type_Application_x_www_form_urlencoded.php
 * @package Emvicy
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <emvicy@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

namespace MVC\Media;

use MVC\MVCTrait\TraitMediaType;

class Type_Application_x_www_form_urlencoded
{
    use TraitMediaType;

    /**
     * @reference [WHATWG]; [Anne_van_Kesteren]
     */
    const DESCRIPTION = 'application/x-www-form-urlencoded';
}