<?php
/**
 * Type_Video_SMPTE292M.php
 * @package Emvicy
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <emvicy@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

namespace MVC\Media;

use MVC\MVCTrait\TraitMediaType;

class Type_Video_SMPTE292M
{
    use TraitMediaType;

    /**
     * @reference [RFC 3497]
     */
    const DESCRIPTION = 'video/SMPTE292M';
}