<?php
/**
 * Type_Application_cmw_json.php
 * @package Emvicy
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <emvicy@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

namespace MVC\Media;

use MVC\MVCTrait\TraitMediaType;

class Type_Application_cmw_json
{
    use TraitMediaType;

    /**
     * @reference [RFC9999, Sections 3.1, 3.2]
     */
    const DESCRIPTION = 'application/cmw+json';
}