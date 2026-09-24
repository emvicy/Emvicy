<?php
/**
 * Type_Audio_ATRAC_X.php
 * @package Emvicy
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <emvicy@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

namespace MVC\Media;

use MVC\MVCTrait\TraitMediaType;

class Type_Audio_ATRAC_X
{
    use TraitMediaType;

    /**
     * @reference [RFC 5584]
     */
    const DESCRIPTION = 'audio/ATRAC-X';
}