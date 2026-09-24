<?php
/**
 * Type_Audio_ATRAC_ADVANCED_LOSSLESS.php
 * @package Emvicy
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <emvicy@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

namespace MVC\Media;

use MVC\MVCTrait\TraitMediaType;

class Type_Audio_ATRAC_ADVANCED_LOSSLESS
{
    use TraitMediaType;

    /**
     * @reference [RFC 5584]
     */
    const DESCRIPTION = 'audio/ATRAC-ADVANCED-LOSSLESS';
}