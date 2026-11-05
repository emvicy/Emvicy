<?php
/**
 * Type_Application_emma_xml.php
 * @package Emvicy
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <emvicy@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

namespace MVC\Media;

use MVC\MVCTrait\TraitMediaType;

class Type_Application_emma_xml
{
    use TraitMediaType;

    /**
     * @reference [W3C]; [http://www.w3.org/TR/2007/CR-emma-20071211/#media-type-registration]; [ISO-IEC_JTC_1]
     */
    const DESCRIPTION = 'application/emma+xml';
}