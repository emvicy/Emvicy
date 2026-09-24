<?php
/**
 * Type_Audio_fwdred.php
 * @package Emvicy
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <emvicy@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

namespace MVC\Media;

use MVC\MVCTrait\TraitMediaType;

class Type_Audio_fwdred
{
    use TraitMediaType;

    /**
     * @reference [RFC 6354]
     */
    const DESCRIPTION = 'audio/fwdred';
}