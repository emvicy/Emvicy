<?php
/**
 * Type_Text_RED.php
 * @package Emvicy
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <emvicy@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

namespace MVC\Media;

use MVC\MVCTrait\TraitMediaType;

class Type_Text_RED
{
    use TraitMediaType;

    /**
     * @reference [RFC 4102]
     */
    const DESCRIPTION = 'text/RED';
}