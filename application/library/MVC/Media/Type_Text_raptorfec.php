<?php
/**
 * Type_Text_raptorfec.php
 * @package Emvicy
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <emvicy@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

namespace MVC\Media;

use MVC\MVCTrait\TraitMediaType;

class Type_Text_raptorfec
{
    use TraitMediaType;

    /**
     * @reference [RFC 6682]
     */
    const DESCRIPTION = 'text/raptorfec';
}