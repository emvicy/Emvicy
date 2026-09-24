<?php
/**
 * Type_Message_mls.php
 * @package Emvicy
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <emvicy@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

namespace MVC\Media;

use MVC\MVCTrait\TraitMediaType;

class Type_Message_mls
{
    use TraitMediaType;

    /**
     * @reference [RFC 9420]
     */
    const DESCRIPTION = 'message/mls';
}