<?php
/**
 * Type_Font_woff2.php
 * @package Emvicy
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <emvicy@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

namespace MVC\Media;

use MVC\MVCTrait\TraitMediaType;

class Type_Font_woff2
{
    use TraitMediaType;

    /**
     * @reference [RFC 8081]
     */
    const DESCRIPTION = 'font/woff2';
}