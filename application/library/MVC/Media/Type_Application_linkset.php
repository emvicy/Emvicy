<?php
/**
 * Type_Application_linkset.php
 * @package Emvicy
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <emvicy@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

namespace MVC\Media;

use MVC\MVCTrait\TraitMediaType;

class Type_Application_linkset
{
    use TraitMediaType;

    /**
     * @reference [RFC 9264]
     */
    const DESCRIPTION = 'application/linkset';
}