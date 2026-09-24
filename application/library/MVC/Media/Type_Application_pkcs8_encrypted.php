<?php
/**
 * Type_Application_pkcs8_encrypted.php
 * @package Emvicy
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <emvicy@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

namespace MVC\Media;

use MVC\MVCTrait\TraitMediaType;

class Type_Application_pkcs8_encrypted
{
    use TraitMediaType;

    /**
     * @reference [RFC 8351]
     */
    const DESCRIPTION = 'application/pkcs8-encrypted';
}