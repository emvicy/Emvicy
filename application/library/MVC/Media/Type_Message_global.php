<?php
/**
 * Type_Message_global.php
 * @package Emvicy
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <emvicy@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

namespace MVC\Media;

use MVC\MVCTrait\TraitMediaType;

class Type_Message_global
{
    use TraitMediaType;

    /**
     * @reference [RFC 6532]
     */
    const DESCRIPTION = 'message/global';
}