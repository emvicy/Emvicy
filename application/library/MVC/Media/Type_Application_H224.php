<?php
/**
 * Type_Application_H224.php
 * @package Emvicy
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <emvicy@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

namespace MVC\Media;

use MVC\MVCTrait\TraitMediaType;

class Type_Application_H224
{
    use TraitMediaType;

    /**
     * @reference [RFC 4573]
     */
    const DESCRIPTION = 'application/H224';
}