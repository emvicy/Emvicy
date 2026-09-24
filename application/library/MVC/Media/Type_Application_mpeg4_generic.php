<?php
/**
 * Type_Application_mpeg4_generic.php
 * @package Emvicy
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <emvicy@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

namespace MVC\Media;

use MVC\MVCTrait\TraitMediaType;

class Type_Application_mpeg4_generic
{
    use TraitMediaType;

    /**
     * @reference [RFC 3640]
     */
    const DESCRIPTION = 'application/mpeg4-generic';
}