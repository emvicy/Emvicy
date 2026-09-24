<?php
/**
 * Type_Application_pkcs10.php
 * @package Emvicy
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <emvicy@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

namespace MVC\Media;

use MVC\MVCTrait\TraitMediaType;

class Type_Application_pkcs10
{
    use TraitMediaType;

    /**
     * @reference [RFC 5967]
     */
    const DESCRIPTION = 'application/pkcs10';
}