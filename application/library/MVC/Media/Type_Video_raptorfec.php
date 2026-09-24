<?php
/**
 * Type_Video_raptorfec.php
 * @package Emvicy
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <emvicy@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

namespace MVC\Media;

use MVC\MVCTrait\TraitMediaType;

class Type_Video_raptorfec
{
    use TraitMediaType;

    /**
     * @reference [RFC 6682]
     */
    const DESCRIPTION = 'video/raptorfec';
}