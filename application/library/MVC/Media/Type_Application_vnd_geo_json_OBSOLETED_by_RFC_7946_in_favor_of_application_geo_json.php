<?php
/**
 * Type_Application_vnd_geo_json_OBSOLETED_by_RFC_7946_in_favor_of_application_geo_json.php
 * @package Emvicy
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <emvicy@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

namespace MVC\Media;

use MVC\MVCTrait\TraitMediaType;

class Type_Application_vnd_geo_json_OBSOLETED_by_RFC_7946_in_favor_of_application_geo_json
{
    use TraitMediaType;

    /**
     * @reference [Sean_Gillies]
	 * @deprecated OBSOLETED by RFC 7946 in favor of application/geojson
     */
    const DESCRIPTION = 'application/vnd.geo+json';
}