<?php
/**
 * Type_Application_xenc_xml.php
 * @package Emvicy
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <emvicy@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

namespace MVC\Media;

use MVC\MVCTrait\TraitMediaType;

class Type_Application_xenc_xml
{
    use TraitMediaType;

    /**
     * @reference [Joseph_Reagle]; [XENC_WG]
     */
    const DESCRIPTION = 'application/xenc+xml';
}