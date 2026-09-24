<?php
/**
 * Type_Image_fits.php
 * @package Emvicy
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <emvicy@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

namespace MVC\Media;

use MVC\MVCTrait\TraitMediaType;

class Type_Image_fits
{
    use TraitMediaType;

    /**
     * @reference [RFC 4047]
     */
    const DESCRIPTION = 'image/fits';
}