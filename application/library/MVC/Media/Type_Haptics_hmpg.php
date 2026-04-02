<?php
/**
 * Type_Haptics_hmpg.php
 * @package Emvicy
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <emvicy@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

namespace MVC\Media;

use MVC\MVCTrait\TraitMediaType;

class Type_Haptics_hmpg
{
    use TraitMediaType;

    /**
     * @reference [RFC9695][RFC-ietf-avtcore-rtp-haptics-13]
     */
    const DESCRIPTION = 'haptics/hmpg';
}