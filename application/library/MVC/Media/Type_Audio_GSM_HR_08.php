<?php
/**
 * Type_Audio_GSM_HR_08.php
 * @package Emvicy
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <emvicy@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

namespace MVC\Media;

use MVC\MVCTrait\TraitMediaType;

class Type_Audio_GSM_HR_08
{
    use TraitMediaType;

    /**
     * @reference [RFC 5993]
     */
    const DESCRIPTION = 'audio/GSM-HR-08';
}