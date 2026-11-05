<?php
/**
 * Type_Image_apng.php
 * @package Emvicy
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <emvicy@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

namespace MVC\Media;

use MVC\MVCTrait\TraitMediaType;

class Type_Image_apng
{
    use TraitMediaType;

    /**
     * @reference [W3C]; [W3C_PNG_WG]
     */
    const DESCRIPTION = 'image/apng';
}