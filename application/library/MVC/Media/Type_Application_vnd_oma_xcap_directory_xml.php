<?php
/**
 * Type_Application_vnd_oma_xcap_directory_xml.php
 * @package Emvicy
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <emvicy@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

namespace MVC\Media;

use MVC\MVCTrait\TraitMediaType;

class Type_Application_vnd_oma_xcap_directory_xml
{
    use TraitMediaType;

    /**
     * @reference [Sean_Kelley]; [OMA_Presence_and_Availability_PAG_WG]
     */
    const DESCRIPTION = 'application/vnd.oma.xcap-directory+xml';
}