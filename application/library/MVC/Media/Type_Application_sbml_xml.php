<?php
/**
 * Type_Application_sbml_xml.php
 * @package Emvicy
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <emvicy@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

namespace MVC\Media;

use MVC\MVCTrait\TraitMediaType;

class Type_Application_sbml_xml
{
    use TraitMediaType;

    /**
     * @reference [RFC 3823]
     */
    const DESCRIPTION = 'application/sbml+xml';
}