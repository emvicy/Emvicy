<?php
/**
 * Type_Application_cose_certhash_cbor.php
 * @package Emvicy
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <emvicy@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

namespace MVC\Media;

use MVC\MVCTrait\TraitMediaType;

class Type_Application_cose_certhash_cbor
{
    use TraitMediaType;

    /**
     * @reference [RFC-ietf-cose-cbor-encoded-cert-20]
     */
    const DESCRIPTION = 'application/cose-certhash+cbor';
}