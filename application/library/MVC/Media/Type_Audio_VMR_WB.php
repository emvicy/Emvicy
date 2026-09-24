<?php
/**
 * Type_Audio_VMR_WB.php
 * @package Emvicy
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <emvicy@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

namespace MVC\Media;

use MVC\MVCTrait\TraitMediaType;

class Type_Audio_VMR_WB
{
    use TraitMediaType;

    /**
     * @reference [RFC 4348][RFC 4424]
     */
    const DESCRIPTION = 'audio/VMR-WB';
}