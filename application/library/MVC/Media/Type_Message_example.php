<?php
/**
 * Type_Message_example.php
 * @package Emvicy
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <emvicy@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

namespace MVC\Media;

use MVC\MVCTrait\TraitMediaType;

class Type_Message_example
{
    use TraitMediaType;

    /**
     * @reference [RFC 4735]
     */
    const DESCRIPTION = 'message/example';
}