<?php
/**
 * Type_Model_vrml.php
 * @package Emvicy
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <emvicy@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

namespace MVC\Media;

use MVC\MVCTrait\TraitMediaType;

class Type_Model_vrml
{
    use TraitMediaType;

    /**
     * @reference [RFC 2077]
     */
    const DESCRIPTION = 'model/vrml';
}