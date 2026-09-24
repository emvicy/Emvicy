<?php
/**
 * Type_Video_MP4V_ES.php
 * @package Emvicy
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <emvicy@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

namespace MVC\Media;

use MVC\MVCTrait\TraitMediaType;

class Type_Video_MP4V_ES
{
    use TraitMediaType;

    /**
     * @reference [RFC 6416]
     */
    const DESCRIPTION = 'video/MP4V-ES';
}