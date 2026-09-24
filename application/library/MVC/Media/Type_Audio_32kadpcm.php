<?php
/**
 * Type_Audio_32kadpcm.php
 * @package Emvicy
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <emvicy@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

namespace MVC\Media;

use MVC\MVCTrait\TraitMediaType;

class Type_Audio_32kadpcm
{
    use TraitMediaType;

    /**
     * @reference [RFC 3802][RFC 2421]
     */
    const DESCRIPTION = 'audio/32kadpcm';
}