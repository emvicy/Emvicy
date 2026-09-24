<?php
/**
 * Type_Audio_opus.php
 * @package Emvicy
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <emvicy@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

namespace MVC\Media;

use MVC\MVCTrait\TraitMediaType;

class Type_Audio_opus
{
    use TraitMediaType;

    /**
     * @reference [RFC 7587]
     */
    const DESCRIPTION = 'audio/opus';
}