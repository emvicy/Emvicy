<?php
/**
 * Type_Audio_TSVCIS.php
 * @package Emvicy
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <emvicy@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

namespace MVC\Media;

use MVC\MVCTrait\TraitMediaType;

class Type_Audio_TSVCIS
{
    use TraitMediaType;

    /**
     * @reference [RFC 8817]
     */
    const DESCRIPTION = 'audio/TSVCIS';
}