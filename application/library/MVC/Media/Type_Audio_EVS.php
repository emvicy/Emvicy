<?php
/**
 * Type_Audio_EVS.php
 * @package Emvicy
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <emvicy@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

namespace MVC\Media;

use MVC\MVCTrait\TraitMediaType;

class Type_Audio_EVS
{
    use TraitMediaType;

    /**
     * @reference [_3GPP]; [Kyunghun_Jung]
     */
    const DESCRIPTION = 'audio/EVS';
}