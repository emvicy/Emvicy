<?php
/**
 * Type_Application_1d_interleaved_parityfec.php
 * @package Emvicy
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <emvicy@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

namespace MVC\Media;

use MVC\MVCTrait\TraitMediaType;

class Type_Application_1d_interleaved_parityfec
{
    use TraitMediaType;

    /**
     * @reference [RFC 6015]
     */
    const DESCRIPTION = 'application/1d-interleaved-parityfec';
}