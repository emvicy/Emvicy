<?php
/**
 * Type_Application_smpte336m.php
 * @package Emvicy
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <emvicy@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

namespace MVC\Media;

use MVC\MVCTrait\TraitMediaType;

class Type_Application_smpte336m
{
    use TraitMediaType;

    /**
     * @reference [RFC 6597]
     */
    const DESCRIPTION = 'application/smpte336m';
}