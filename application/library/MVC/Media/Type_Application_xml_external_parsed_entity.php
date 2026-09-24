<?php
/**
 * Type_Application_xml_external_parsed_entity.php
 * @package Emvicy
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <emvicy@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

namespace MVC\Media;

use MVC\MVCTrait\TraitMediaType;

class Type_Application_xml_external_parsed_entity
{
    use TraitMediaType;

    /**
     * @reference [RFC 7303]
     */
    const DESCRIPTION = 'application/xml-external-parsed-entity';
}