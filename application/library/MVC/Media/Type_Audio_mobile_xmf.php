<?php
/**
 * Type_Audio_mobile_xmf.php
 * @package Emvicy
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <emvicy@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

namespace MVC\Media;

use MVC\MVCTrait\TraitMediaType;

class Type_Audio_mobile_xmf
{
    use TraitMediaType;

    /**
     * @reference [RFC 4723]
     */
    const DESCRIPTION = 'audio/mobile-xmf';
}