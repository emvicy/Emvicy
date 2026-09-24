<?php
/**
 * Type_Audio_G719.php
 * @package Emvicy
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <emvicy@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

namespace MVC\Media;

use MVC\MVCTrait\TraitMediaType;

class Type_Audio_G719
{
    use TraitMediaType;

    /**
     * @reference [RFC 5404][RFC Errata 3245]
     */
    const DESCRIPTION = 'audio/G719';
}