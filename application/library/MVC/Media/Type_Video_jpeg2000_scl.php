<?php
/**
 * Type_Video_jpeg2000_scl.php
 * @package Emvicy
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <emvicy@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

namespace MVC\Media;

use MVC\MVCTrait\TraitMediaType;

class Type_Video_jpeg2000_scl
{
    use TraitMediaType;

    /**
     * @reference [RFC9828]
     */
    const DESCRIPTION = 'video/jpeg2000-scl';
}