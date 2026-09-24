<?php
/**
 * Type_Application_missing_blocks_cbor_seq.php
 * @package Emvicy
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <emvicy@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

namespace MVC\Media;

use MVC\MVCTrait\TraitMediaType;

class Type_Application_missing_blocks_cbor_seq
{
    use TraitMediaType;

    /**
     * @reference [RFC 9177]
     */
    const DESCRIPTION = 'application/missing-blocks+cbor-seq';
}