<?php
/**
 * Type_Video_mpeg4_generic.php
 * @package Emvicy
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <emvicy@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

namespace MVC\Media;

use MVC\MVCTrait\TraitMediaType;

class Type_Video_mpeg4_generic
{
    use TraitMediaType;

    /**
     * @reference [RFC 3640]
     */
    const DESCRIPTION = 'video/mpeg4-generic';
}