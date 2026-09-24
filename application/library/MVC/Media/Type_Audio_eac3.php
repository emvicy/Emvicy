<?php
/**
 * Type_Audio_eac3.php
 * @package Emvicy
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <emvicy@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

namespace MVC\Media;

use MVC\MVCTrait\TraitMediaType;

class Type_Audio_eac3
{
    use TraitMediaType;

    /**
     * @reference [RFC 4598]
     */
    const DESCRIPTION = 'audio/eac3';
}