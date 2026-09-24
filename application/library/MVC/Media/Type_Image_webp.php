<?php
/**
 * Type_Image_webp.php
 * @package Emvicy
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <emvicy@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

namespace MVC\Media;

use MVC\MVCTrait\TraitMediaType;

class Type_Image_webp
{
    use TraitMediaType;

    /**
     * @reference [RFC 9649]
     */
    const DESCRIPTION = 'image/webp';
}