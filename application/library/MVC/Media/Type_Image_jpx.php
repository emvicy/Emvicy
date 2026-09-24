<?php
/**
 * Type_Image_jpx.php
 * @package Emvicy
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <emvicy@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

namespace MVC\Media;

use MVC\MVCTrait\TraitMediaType;

class Type_Image_jpx
{
    use TraitMediaType;

    /**
     * @reference [RFC 3745][ISO-IEC_JTC_1_SC_29_WG_1]
     */
    const DESCRIPTION = 'image/jpx';
}