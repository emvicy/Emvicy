<?php
/**
 * Type_Application_vnd_geogebra_slides.php
 * @package Emvicy
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <emvicy@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

namespace MVC\Media;

use MVC\MVCTrait\TraitMediaType;

class Type_Application_vnd_geogebra_slides
{
    use TraitMediaType;

    /**
     * @reference [GeoGebra]; [Michael_Borcherds]; [Markus_Hohenwarter]
     */
    const DESCRIPTION = 'application/vnd.geogebra.slides';
}