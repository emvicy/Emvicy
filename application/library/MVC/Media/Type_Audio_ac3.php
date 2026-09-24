<?php
/**
 * Type_Audio_ac3.php
 * @package Emvicy
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <emvicy@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

namespace MVC\Media;

use MVC\MVCTrait\TraitMediaType;

class Type_Audio_ac3
{
    use TraitMediaType;

    /**
     * @reference [RFC 4184]
     */
    const DESCRIPTION = 'audio/ac3';
}