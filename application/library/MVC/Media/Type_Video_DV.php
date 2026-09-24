<?php
/**
 * Type_Video_DV.php
 * @package Emvicy
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <emvicy@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

namespace MVC\Media;

use MVC\MVCTrait\TraitMediaType;

class Type_Video_DV
{
    use TraitMediaType;

    /**
     * @reference [RFC 6469]
     */
    const DESCRIPTION = 'video/DV';
}