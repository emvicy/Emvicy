<?php
/**
 * Type_Application_pkix_pkipath.php
 * @package Emvicy
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <emvicy@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

namespace MVC\Media;

use MVC\MVCTrait\TraitMediaType;

class Type_Application_pkix_pkipath
{
    use TraitMediaType;

    /**
     * @reference [RFC 6066]
     */
    const DESCRIPTION = 'application/pkix-pkipath';
}