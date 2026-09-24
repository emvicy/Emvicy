<?php
/**
 * Type_Image_g3fax.php
 * @package Emvicy
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <emvicy@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

namespace MVC\Media;

use MVC\MVCTrait\TraitMediaType;

class Type_Image_g3fax
{
    use TraitMediaType;

    /**
     * @reference [RFC 1494]
     */
    const DESCRIPTION = 'image/g3fax';
}