<?php
/**
 * Type_Audio_vnd_qcelp_DEPRECATED_in_favor_of_audio_qcelp.php
 * @package Emvicy
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <emvicy@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

namespace MVC\Media;

use MVC\MVCTrait\TraitMediaType;

class Type_Audio_vnd_qcelp_DEPRECATED_in_favor_of_audio_qcelp
{
    use TraitMediaType;

    /**
     * @reference [RFC 3625]
     */
    const DESCRIPTION = 'audio/vnd.qcelp';
}