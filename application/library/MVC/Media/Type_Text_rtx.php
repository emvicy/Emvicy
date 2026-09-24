<?php
/**
 * Type_Text_rtx.php
 * @package Emvicy
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <emvicy@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

namespace MVC\Media;

use MVC\MVCTrait\TraitMediaType;

class Type_Text_rtx
{
    use TraitMediaType;

    /**
     * @reference [RFC 4588]
     */
    const DESCRIPTION = 'text/rtx';
}