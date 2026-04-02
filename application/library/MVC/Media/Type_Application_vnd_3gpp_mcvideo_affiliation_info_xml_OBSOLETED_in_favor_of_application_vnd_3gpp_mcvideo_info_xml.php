<?php
/**
 * Type_Application_vnd_3gpp_mcvideo_affiliation_info_xml_OBSOLETED_in_favor_of_application_vnd_3gpp_mcvideo_info_xml.php
 * @package Emvicy
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <emvicy@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

namespace MVC\Media;

use MVC\MVCTrait\TraitMediaType;

class Type_Application_vnd_3gpp_mcvideo_affiliation_info_xml_OBSOLETED_in_favor_of_application_vnd_3gpp_mcvideo_info_xml
{
    use TraitMediaType;

    /**
     * @reference [Dongwook_Kim]
	 * @deprecated OBSOLETED in favor of application/vnd3gppmcvideo-infoxml
     */
    const DESCRIPTION = 'application/vnd.3gpp.mcvideo-affiliation-info+xml';
}