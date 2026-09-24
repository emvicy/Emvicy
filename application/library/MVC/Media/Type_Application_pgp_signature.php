<?php
/**
 * Type_Application_pgp_signature.php
 * @package Emvicy
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <emvicy@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

namespace MVC\Media;

use MVC\MVCTrait\TraitMediaType;

class Type_Application_pgp_signature
{
    use TraitMediaType;

    /**
     * @reference [RFC 3156]
     */
    const DESCRIPTION = 'application/pgp-signature';
}