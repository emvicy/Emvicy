<?php
/**
 * Type_Multipart_mixed.php
 * @package Emvicy
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <emvicy@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

namespace MVC\Media;

use MVC\MVCTrait\TraitMediaType;

class Type_Multipart_mixed
{
    use TraitMediaType;

    /**
     * @reference [RFC 2046][RFC 2045]
     */
    const DESCRIPTION = 'multipart/mixed';
}