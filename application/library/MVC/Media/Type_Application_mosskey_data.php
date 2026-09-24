<?php
/**
 * Type_Application_mosskey_data.php
 * @package Emvicy
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <emvicy@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

namespace MVC\Media;

use MVC\MVCTrait\TraitMediaType;

class Type_Application_mosskey_data
{
    use TraitMediaType;

    /**
     * @reference [RFC 1848]
     */
    const DESCRIPTION = 'application/mosskey-data';
}