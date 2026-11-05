<?php
/**
 * Type_Application_fhir_json.php
 * @package Emvicy
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <emvicy@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

namespace MVC\Media;

use MVC\MVCTrait\TraitMediaType;

class Type_Application_fhir_json
{
    use TraitMediaType;

    /**
     * @reference [HL7]; [Grahame_Grieve]
     */
    const DESCRIPTION = 'application/fhir+json';
}