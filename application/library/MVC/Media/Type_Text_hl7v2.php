<?php
/**
 * Type_Text_hl7v2.php
 * @package Emvicy
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <emvicy@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

namespace MVC\Media;

use MVC\MVCTrait\TraitMediaType;

class Type_Text_hl7v2
{
    use TraitMediaType;

    /**
     * @reference [HL7]; [Marc_Duteau]
     */
    const DESCRIPTION = 'text/hl7v2';
}