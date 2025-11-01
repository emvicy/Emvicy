<?php
/**
 * Type_Application_vnd_fdsn_stationxml_xml.php
 * @package Emvicy
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <emvicy@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

namespace MVC\Media;

use MVC\MVCTrait\TraitMediaType;

class Type_Application_vnd_fdsn_stationxml_xml
{
    use TraitMediaType;

    /**
     * @reference [International_FDSN]
     */
    const DESCRIPTION = 'application/vnd.fdsn.stationxml+xml';
}