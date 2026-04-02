<?php
/**
 * Type_Application_roughtime_malfeasance_json.php
 * @package Emvicy
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <emvicy@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

namespace MVC\Media;

use MVC\MVCTrait\TraitMediaType;

class Type_Application_roughtime_malfeasance_json
{
    use TraitMediaType;

    /**
     * @reference [RFC-ietf-ntp-roughtime-19]
     */
    const DESCRIPTION = 'application/roughtime-malfeasance+json';
}