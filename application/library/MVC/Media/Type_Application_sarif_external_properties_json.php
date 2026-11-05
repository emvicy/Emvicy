<?php
/**
 * Type_Application_sarif_external_properties_json.php
 * @package Emvicy
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <emvicy@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

namespace MVC\Media;

use MVC\MVCTrait\TraitMediaType;

class Type_Application_sarif_external_properties_json
{
    use TraitMediaType;

    /**
     * @reference [OASIS]; [David_Keaton]; [Michael_C._Fanning]
     */
    const DESCRIPTION = 'application/sarif-external-properties+json';
}