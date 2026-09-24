<?php
/**
 * Type_Application_pskc_xml.php
 * @package Emvicy
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <emvicy@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

namespace MVC\Media;

use MVC\MVCTrait\TraitMediaType;

class Type_Application_pskc_xml
{
    use TraitMediaType;

    /**
     * @reference [RFC 6030]
     */
    const DESCRIPTION = 'application/pskc+xml';
}