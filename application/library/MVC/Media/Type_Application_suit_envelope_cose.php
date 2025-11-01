<?php
/**
 * Type_Application_suit_envelope_cose.php
 * @package Emvicy
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <emvicy@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

namespace MVC\Media;

use MVC\MVCTrait\TraitMediaType;

class Type_Application_suit_envelope_cose
{
    use TraitMediaType;

    /**
     * @reference [RFC-ietf-suit-manifest-34]
     */
    const DESCRIPTION = 'application/suit-envelope+cose';
}