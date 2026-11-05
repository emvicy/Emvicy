<?php
/**
 * Type_Application_vnd_sealed_tiff.php
 * @package Emvicy
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <emvicy@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

namespace MVC\Media;

use MVC\MVCTrait\TraitMediaType;

class Type_Application_vnd_sealed_tiff
{
    use TraitMediaType;

    /**
     * @reference [John_Kwan]; [Martin_Lambert]
     */
    const DESCRIPTION = 'application/vnd.sealed.tiff';
}