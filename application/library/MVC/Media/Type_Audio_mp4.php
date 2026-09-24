<?php
/**
 * Type_Audio_mp4.php
 * @package Emvicy
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <emvicy@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

namespace MVC\Media;

use MVC\MVCTrait\TraitMediaType;

class Type_Audio_mp4
{
    use TraitMediaType;

    /**
     * @reference [RFC 4337][RFC 6381]
     */
    const DESCRIPTION = 'audio/mp4';
}