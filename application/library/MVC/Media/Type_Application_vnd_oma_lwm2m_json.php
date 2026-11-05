<?php
/**
 * Type_Application_vnd_oma_lwm2m_json.php
 * @package Emvicy
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <emvicy@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

namespace MVC\Media;

use MVC\MVCTrait\TraitMediaType;

class Type_Application_vnd_oma_lwm2m_json
{
    use TraitMediaType;

    /**
     * @reference [Open_Mobile_Naming_Authority]; [John_Mudge]
     */
    const DESCRIPTION = 'application/vnd.oma.lwm2m+json';
}