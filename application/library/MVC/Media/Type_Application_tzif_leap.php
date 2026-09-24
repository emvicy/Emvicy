<?php
/**
 * Type_Application_tzif_leap.php
 * @package Emvicy
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <emvicy@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

namespace MVC\Media;

use MVC\MVCTrait\TraitMediaType;

class Type_Application_tzif_leap
{
    use TraitMediaType;

    /**
     * @reference [RFC 9636][RFC Errata 9028]
     */
    const DESCRIPTION = 'application/tzif-leap';
}