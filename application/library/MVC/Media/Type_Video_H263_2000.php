<?php
/**
 * Type_Video_H263_2000.php
 * @package Emvicy
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <emvicy@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

namespace MVC\Media;

use MVC\MVCTrait\TraitMediaType;

class Type_Video_H263_2000
{
    use TraitMediaType;

    /**
     * @reference [RFC 4629]
     */
    const DESCRIPTION = 'video/H263-2000';
}