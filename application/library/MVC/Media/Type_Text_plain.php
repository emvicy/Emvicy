<?php
/**
 * Type_Text_plain.php
 * @package Emvicy
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <emvicy@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

namespace MVC\Media;

use MVC\MVCTrait\TraitMediaType;

class Type_Text_plain
{
    use TraitMediaType;

    /**
     * @reference [RFC 2046][RFC 3676][RFC 5147]
     */
    const DESCRIPTION = 'text/plain';
}