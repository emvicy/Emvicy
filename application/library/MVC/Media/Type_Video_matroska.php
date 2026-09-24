<?php
/**
 * Type_Video_matroska.php
 * @package Emvicy
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <emvicy@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

namespace MVC\Media;

use MVC\MVCTrait\TraitMediaType;

class Type_Video_matroska
{
    use TraitMediaType;

    /**
     * @reference [RFC 9559]
     */
    const DESCRIPTION = 'video/matroska';
}