<?php
/**
 * Type_Video_VP8.php
 * @package Emvicy
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <emvicy@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

namespace MVC\Media;

use MVC\MVCTrait\TraitMediaType;

class Type_Video_VP8
{
    use TraitMediaType;

    /**
     * @reference [RFC 7741]
     */
    const DESCRIPTION = 'video/VP8';
}