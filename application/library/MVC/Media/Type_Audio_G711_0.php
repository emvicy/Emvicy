<?php
/**
 * Type_Audio_G711_0.php
 * @package Emvicy
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <emvicy@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

namespace MVC\Media;

use MVC\MVCTrait\TraitMediaType;

class Type_Audio_G711_0
{
    use TraitMediaType;

    /**
     * @reference [RFC 7655]
     */
    const DESCRIPTION = 'audio/G711-0';
}