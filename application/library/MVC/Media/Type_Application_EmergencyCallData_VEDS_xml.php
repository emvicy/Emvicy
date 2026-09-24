<?php
/**
 * Type_Application_EmergencyCallData_VEDS_xml.php
 * @package Emvicy
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <emvicy@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

namespace MVC\Media;

use MVC\MVCTrait\TraitMediaType;

class Type_Application_EmergencyCallData_VEDS_xml
{
    use TraitMediaType;

    /**
     * @reference [RFC 8148][RFC Errata 6500]
     */
    const DESCRIPTION = 'application/EmergencyCallData.VEDS+xml';
}