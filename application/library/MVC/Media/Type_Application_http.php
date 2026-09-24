<?php
/**
 * Type_Application_http.php
 * @package Emvicy
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <emvicy@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

namespace MVC\Media;

use MVC\MVCTrait\TraitMediaType;

class Type_Application_http
{
    use TraitMediaType;

    /**
     * @reference [RFC 9112]
     */
    const DESCRIPTION = 'application/http';
}