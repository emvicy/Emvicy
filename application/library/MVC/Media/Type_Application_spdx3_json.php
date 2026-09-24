<?php
/**
 * Type_Application_spdx3_json.php
 * @package Emvicy
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <emvicy@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

namespace MVC\Media;

use MVC\MVCTrait\TraitMediaType;

class Type_Application_spdx3_json
{
    use TraitMediaType;

    /**
     * @reference [Linux_Foundation][Arthit_Suriyawongkul]
     */
    const DESCRIPTION = 'application/spdx3+json';
}