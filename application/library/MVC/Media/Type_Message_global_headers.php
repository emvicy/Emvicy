<?php
/**
 * Type_Message_global_headers.php
 * @package Emvicy
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <emvicy@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

namespace MVC\Media;

use MVC\MVCTrait\TraitMediaType;

class Type_Message_global_headers
{
    use TraitMediaType;

    /**
     * @reference [RFC 6533]
     */
    const DESCRIPTION = 'message/global-headers';
}