<?php
/**
 * Type_Application_rpki_signed_tal.php
 * @package Emvicy
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <emvicy@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

namespace MVC\Media;

use MVC\MVCTrait\TraitMediaType;

class Type_Application_rpki_signed_tal
{
    use TraitMediaType;

    /**
     * @reference [RFC 9691]
     */
    const DESCRIPTION = 'application/rpki-signed-tal';
}