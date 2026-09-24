<?php
/**
 * Type_Application_pkcs7_mime.php
 * @package Emvicy
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <emvicy@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

namespace MVC\Media;

use MVC\MVCTrait\TraitMediaType;

class Type_Application_pkcs7_mime
{
    use TraitMediaType;

    /**
     * @reference [RFC 8551][RFC 7114]
     */
    const DESCRIPTION = 'application/pkcs7-mime';
}