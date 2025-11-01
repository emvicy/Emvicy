<?php
/**
 * Type_Haptics_ivs.php
 * @package Emvicy
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <emvicy@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

namespace MVC\Media;

use MVC\MVCTrait\TraitMediaType;

class Type_Haptics_ivs
{
    use TraitMediaType;

    /**
     * @reference [RFC9695]
     */
    const DESCRIPTION = 'haptics/ivs';
}