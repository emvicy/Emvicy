<?php
/**
 * Type_Application_xml_dtd.php
 * @package Emvicy
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <emvicy@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

namespace MVC\Media;

use MVC\MVCTrait\TraitMediaType;

class Type_Application_xml_dtd
{
    use TraitMediaType;

    /**
     * @reference [RFC 7303]
     */
    const DESCRIPTION = 'application/xml-dtd';
}