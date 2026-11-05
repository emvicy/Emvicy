<?php
/**
 * Type_Text_prs_mtsv.php
 * @package Emvicy
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <emvicy@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

namespace MVC\Media;

use MVC\MVCTrait\TraitMediaType;

class Type_Text_prs_mtsv
{
    use TraitMediaType;

    /**
     * @reference [draft-demosra-mtsv-01]
     */
    const DESCRIPTION = 'text/prs.mtsv';
}