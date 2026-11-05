<?php
/**
 * Type_Application_vnd_etsi_pstn_xml.php
 * @package Emvicy
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <emvicy@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

namespace MVC\Media;

use MVC\MVCTrait\TraitMediaType;

class Type_Application_vnd_etsi_pstn_xml
{
    use TraitMediaType;

    /**
     * @reference [Jiwan_Han]; [Thomas_Belling]
     */
    const DESCRIPTION = 'application/vnd.etsi.pstn+xml';
}