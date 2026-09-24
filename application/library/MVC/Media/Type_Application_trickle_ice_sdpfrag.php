<?php
/**
 * Type_Application_trickle_ice_sdpfrag.php
 * @package Emvicy
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <emvicy@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

namespace MVC\Media;

use MVC\MVCTrait\TraitMediaType;

class Type_Application_trickle_ice_sdpfrag
{
    use TraitMediaType;

    /**
     * @reference [RFC 8840]
     */
    const DESCRIPTION = 'application/trickle-ice-sdpfrag';
}