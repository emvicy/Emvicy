<?php
/**
 * Type_Application_vnd_oma_dd2_xml.php
 * @package Emvicy
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <emvicy@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

namespace MVC\Media;

use MVC\MVCTrait\TraitMediaType;

class Type_Application_vnd_oma_dd2_xml
{
    use TraitMediaType;

    /**
     * @reference [Jun_Sato]; [Open_Mobile_Alliance_BAC_DLDRM_WG]
     */
    const DESCRIPTION = 'application/vnd.oma.dd2+xml';
}