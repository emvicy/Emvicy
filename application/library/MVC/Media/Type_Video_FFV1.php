<?php
/**
 * Type_Video_FFV1.php
 * @package Emvicy
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <emvicy@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

namespace MVC\Media;

use MVC\MVCTrait\TraitMediaType;

class Type_Video_FFV1
{
    use TraitMediaType;

    /**
     * @reference [RFC 9043]
     */
    const DESCRIPTION = 'video/FFV1';
}