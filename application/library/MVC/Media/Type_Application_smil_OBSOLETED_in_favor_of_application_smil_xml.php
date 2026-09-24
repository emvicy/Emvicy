<?php
/**
 * Type_Application_smil_OBSOLETED_in_favor_of_application_smil_xml.php
 * @package Emvicy
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <emvicy@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

namespace MVC\Media;

use MVC\MVCTrait\TraitMediaType;

class Type_Application_smil_OBSOLETED_in_favor_of_application_smil_xml
{
    use TraitMediaType;

    /**
     * @reference [RFC 4536]
	 * @deprecated OBSOLETED in favor of application/smilxml
     */
    const DESCRIPTION = 'application/smil';
}