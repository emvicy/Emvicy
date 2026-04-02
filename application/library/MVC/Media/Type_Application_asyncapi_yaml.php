<?php
/**
 * Type_Application_asyncapi_yaml.php
 * @package Emvicy
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <emvicy@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

namespace MVC\Media;

use MVC\MVCTrait\TraitMediaType;

class Type_Application_asyncapi_yaml
{
    use TraitMediaType;

    /**
     * @reference [Linux_Foundation][AsyncAPI_Initiative]
     */
    const DESCRIPTION = 'application/asyncapi+yaml';
}