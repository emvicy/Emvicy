<?php
/**
 * Type_Application_vnd_apple_steering_list.php
 * @package Emvicy
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <emvicy@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

namespace MVC\Media;

use MVC\MVCTrait\TraitMediaType;

class Type_Application_vnd_apple_steering_list
{
    use TraitMediaType;

    /**
     * @reference [RFC-pantos-content-steering-05]
     */
    const DESCRIPTION = 'application/vnd.apple.steering-list';
}