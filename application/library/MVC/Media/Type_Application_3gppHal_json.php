<?php
/**
 * Type_Application_3gppHal_json.php
 * @package Emvicy
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <emvicy@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

namespace MVC\Media;

use MVC\MVCTrait\TraitMediaType;

class Type_Application_3gppHal_json
{
    use TraitMediaType;

    /**
     * @reference [_3GPP]; [Dongwook_Kim]
     */
    const DESCRIPTION = 'application/3gppHal+json';
}