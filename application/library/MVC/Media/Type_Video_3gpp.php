<?php
/**
 * Type_Video_3gpp.php
 * @package Emvicy
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <emvicy@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

namespace MVC\Media;

use MVC\MVCTrait\TraitMediaType;

class Type_Video_3gpp
{
    use TraitMediaType;

    /**
     * @reference [RFC 3839][RFC 6381]
     */
    const DESCRIPTION = 'video/3gpp';
}