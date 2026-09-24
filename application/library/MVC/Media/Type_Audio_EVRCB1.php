<?php
/**
 * Type_Audio_EVRCB1.php
 * @package Emvicy
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <emvicy@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

namespace MVC\Media;

use MVC\MVCTrait\TraitMediaType;

class Type_Audio_EVRCB1
{
    use TraitMediaType;

    /**
     * @reference [RFC 4788]
     */
    const DESCRIPTION = 'audio/EVRCB1';
}