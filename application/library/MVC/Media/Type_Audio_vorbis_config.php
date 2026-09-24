<?php
/**
 * Type_Audio_vorbis_config.php
 * @package Emvicy
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <emvicy@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

namespace MVC\Media;

use MVC\MVCTrait\TraitMediaType;

class Type_Audio_vorbis_config
{
    use TraitMediaType;

    /**
     * @reference [RFC 5215]
     */
    const DESCRIPTION = 'audio/vorbis-config';
}