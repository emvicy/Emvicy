<?php
/**
 * Type_Application_swid_xml.php
 * @package Emvicy
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <emvicy@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

namespace MVC\Media;

use MVC\MVCTrait\TraitMediaType;

class Type_Application_swid_xml
{
    use TraitMediaType;

    /**
     * @reference [ISO-IEC_JTC_1]; [David_Waltermire]; [Ron_Brill]
     */
    const DESCRIPTION = 'application/swid+xml';
}