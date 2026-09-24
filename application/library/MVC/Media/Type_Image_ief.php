<?php
/**
 * Type_Image_ief.php
 * @package Emvicy
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <emvicy@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

namespace MVC\Media;

use MVC\MVCTrait\TraitMediaType;

class Type_Image_ief
{
    use TraitMediaType;

    /**
     * @reference [RFC 1314]
     */
    const DESCRIPTION = 'image/ief';
}