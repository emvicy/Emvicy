<?php
/**
 * Type_Application_ogg.php
 * @package Emvicy
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <emvicy@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

namespace MVC\Media;

use MVC\MVCTrait\TraitMediaType;

class Type_Application_ogg
{
    use TraitMediaType;

    /**
     * @reference [RFC 5334][RFC 7845]
     */
    const DESCRIPTION = 'application/ogg';
}