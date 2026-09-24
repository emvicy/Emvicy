<?php
/**
 * Type_Application_multipart_core.php
 * @package Emvicy
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <emvicy@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

namespace MVC\Media;

use MVC\MVCTrait\TraitMediaType;

class Type_Application_multipart_core
{
    use TraitMediaType;

    /**
     * @reference [RFC 8710]
     */
    const DESCRIPTION = 'application/multipart-core';
}