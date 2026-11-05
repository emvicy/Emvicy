<?php
/**
 * Type_Text_cache_manifest.php
 * @package Emvicy
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <emvicy@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

namespace MVC\Media;

use MVC\MVCTrait\TraitMediaType;

class Type_Text_cache_manifest
{
    use TraitMediaType;

    /**
     * @reference [W3C]; [Robin_Berjon]
     */
    const DESCRIPTION = 'text/cache-manifest';
}