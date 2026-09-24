<?php
/**
 * Type_Application_alto_endpointcost_json.php
 * @package Emvicy
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <emvicy@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

namespace MVC\Media;

use MVC\MVCTrait\TraitMediaType;

class Type_Application_alto_endpointcost_json
{
    use TraitMediaType;

    /**
     * @reference [RFC 7285]
     */
    const DESCRIPTION = 'application/alto-endpointcost+json';
}