<?php
/**
 * Type_Audio_MP4A_LATM.php
 * @package Emvicy
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <emvicy@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

namespace MVC\Media;

use MVC\MVCTrait\TraitMediaType;

class Type_Audio_MP4A_LATM
{
    use TraitMediaType;

    /**
     * @reference [RFC 6416]
     */
    const DESCRIPTION = 'audio/MP4A-LATM';
}