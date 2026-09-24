<?php
/**
 * Type_Audio_dsr_es201108.php
 * @package Emvicy
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <emvicy@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

namespace MVC\Media;

use MVC\MVCTrait\TraitMediaType;

class Type_Audio_dsr_es201108
{
    use TraitMediaType;

    /**
     * @reference [RFC 3557]
     */
    const DESCRIPTION = 'audio/dsr-es201108';
}