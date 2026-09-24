<?php
/**
 * Type_Audio_G722.php
 * @package Emvicy
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <emvicy@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

namespace MVC\Media;

use MVC\MVCTrait\TraitMediaType;

class Type_Audio_G722
{
    use TraitMediaType;

    /**
     * @reference [RFC 4856]
     */
    const DESCRIPTION = 'audio/G722';
}