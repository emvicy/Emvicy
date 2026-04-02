<?php
/**
 * Type_Application_roughtime_server_json.php
 * @package Emvicy
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <emvicy@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

namespace MVC\Media;

use MVC\MVCTrait\TraitMediaType;

class Type_Application_roughtime_server_json
{
    use TraitMediaType;

    /**
     * @reference [RFC-ietf-ntp-roughtime-19]
     */
    const DESCRIPTION = 'application/roughtime-server+json';
}