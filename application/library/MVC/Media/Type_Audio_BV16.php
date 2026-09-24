<?php
/**
 * Type_Audio_BV16.php
 * @package Emvicy
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <emvicy@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

namespace MVC\Media;

use MVC\MVCTrait\TraitMediaType;

class Type_Audio_BV16
{
    use TraitMediaType;

    /**
     * @reference [RFC 4298]
     */
    const DESCRIPTION = 'audio/BV16';
}