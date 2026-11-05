<?php
/**
 * Type_Application_EmergencyCallData_LegacyESN_json.php
 * @package Emvicy
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <emvicy@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

namespace MVC\Media;

use MVC\MVCTrait\TraitMediaType;

class Type_Application_EmergencyCallData_LegacyESN_json
{
    use TraitMediaType;

    /**
     * @reference [NENA]; [Randall_Gellens]
     */
    const DESCRIPTION = 'application/EmergencyCallData.LegacyESN+json';
}