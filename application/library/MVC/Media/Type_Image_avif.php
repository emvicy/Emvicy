<?php
/**
 * Type_Image_avif.php
 * @package Emvicy
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <emvicy@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

namespace MVC\Media;

use MVC\MVCTrait\TraitMediaType;

class Type_Image_avif
{
    use TraitMediaType;

    /**
     * @reference [Alliance_for_Open_Media]; [Cyril_Concolato]
     */
    const DESCRIPTION = 'image/avif';
}