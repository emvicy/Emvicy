<?php
/**
 * Type_Application_postscript.php
 * @package Emvicy
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <emvicy@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

namespace MVC\Media;

use MVC\MVCTrait\TraitMediaType;

class Type_Application_postscript
{
    use TraitMediaType;

    /**
     * @reference [RFC 2045][RFC 2046]
     */
    const DESCRIPTION = 'application/postscript';
}