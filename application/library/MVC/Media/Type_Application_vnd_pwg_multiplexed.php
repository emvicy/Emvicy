<?php
/**
 * Type_Application_vnd_pwg_multiplexed.php
 * @package Emvicy
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <emvicy@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

namespace MVC\Media;

use MVC\MVCTrait\TraitMediaType;

class Type_Application_vnd_pwg_multiplexed
{
    use TraitMediaType;

    /**
     * @reference [RFC 3391]
     */
    const DESCRIPTION = 'application/vnd.pwg-multiplexed';
}