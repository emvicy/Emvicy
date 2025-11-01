<?php
/**
 * Type_Video_lottie_json.php
 * @package Emvicy
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <emvicy@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

namespace MVC\Media;

use MVC\MVCTrait\TraitMediaType;

class Type_Video_lottie_json
{
    use TraitMediaType;

    /**
     * @reference [Lottie_Animation_Community]
     */
    const DESCRIPTION = 'video/lottie+json';
}