<?php
/**
 * Type_Audio_UEMCLIP.php
 * @package Emvicy
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <emvicy@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

namespace MVC\Media;

use MVC\MVCTrait\TraitMediaType;

class Type_Audio_UEMCLIP
{
    use TraitMediaType;

    /**
     * @reference [RFC 5686]
     */
    const DESCRIPTION = 'audio/UEMCLIP';
}