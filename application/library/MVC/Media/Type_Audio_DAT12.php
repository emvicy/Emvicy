<?php
/**
 * Type_Audio_DAT12.php
 * @package Emvicy
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <emvicy@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

namespace MVC\Media;

use MVC\MVCTrait\TraitMediaType;

class Type_Audio_DAT12
{
    use TraitMediaType;

    /**
     * @reference [RFC 3190]
     */
    const DESCRIPTION = 'audio/DAT12';
}