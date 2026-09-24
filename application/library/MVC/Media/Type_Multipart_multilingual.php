<?php
/**
 * Type_Multipart_multilingual.php
 * @package Emvicy
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <emvicy@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

namespace MVC\Media;

use MVC\MVCTrait\TraitMediaType;

class Type_Multipart_multilingual
{
    use TraitMediaType;

    /**
     * @reference [RFC 8255]
     */
    const DESCRIPTION = 'multipart/multilingual';
}