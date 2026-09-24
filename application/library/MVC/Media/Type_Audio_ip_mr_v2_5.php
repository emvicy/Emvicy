<?php
/**
 * Type_Audio_ip_mr_v2_5.php
 * @package Emvicy
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <emvicy@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

namespace MVC\Media;

use MVC\MVCTrait\TraitMediaType;

class Type_Audio_ip_mr_v2_5
{
    use TraitMediaType;

    /**
     * @reference [RFC 6262]
     */
    const DESCRIPTION = 'audio/ip-mr_v2.5';
}