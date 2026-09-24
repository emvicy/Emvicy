<?php
/**
 * Type_Application_marc.php
 * @package Emvicy
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <emvicy@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

namespace MVC\Media;

use MVC\MVCTrait\TraitMediaType;

class Type_Application_marc
{
    use TraitMediaType;

    /**
     * @reference [RFC 2220]
     */
    const DESCRIPTION = 'application/marc';
}