<?php
/**
 * Type_Application_eat_ucs_cbor.php
 * @package Emvicy
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <emvicy@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

namespace MVC\Media;

use MVC\MVCTrait\TraitMediaType;

class Type_Application_eat_ucs_cbor
{
    use TraitMediaType;

    /**
     * @reference [RFC9782]
     */
    const DESCRIPTION = 'application/eat-ucs+cbor';
}