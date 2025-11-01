<?php
/**
 * Type_Video_VP9.php
 * @package Emvicy
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <emvicy@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

namespace MVC\Media;

use MVC\MVCTrait\TraitMediaType;

class Type_Video_VP9
{
    use TraitMediaType;

    /**
     * @reference [RFC9628]
     */
    const DESCRIPTION = 'video/VP9';
}