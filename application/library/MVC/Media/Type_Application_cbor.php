<?php
/**
 * Type_Application_cbor.php
 * @package Emvicy
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <emvicy@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

namespace MVC\Media;

use MVC\MVCTrait\TraitMediaType;

class Type_Application_cbor
{
    use TraitMediaType;

    /**
     * @reference [RFC 8949]
     */
    const DESCRIPTION = 'application/cbor';
}