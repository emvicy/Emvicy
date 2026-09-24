<?php
/**
 * Type_Audio_mpa_robust.php
 * @package Emvicy
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <emvicy@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

namespace MVC\Media;

use MVC\MVCTrait\TraitMediaType;

class Type_Audio_mpa_robust
{
    use TraitMediaType;

    /**
     * @reference [RFC 5219]
     */
    const DESCRIPTION = 'audio/mpa-robust';
}