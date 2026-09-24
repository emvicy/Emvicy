<?php
/**
 * Type_Application_yaml.php
 * @package Emvicy
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <emvicy@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

namespace MVC\Media;

use MVC\MVCTrait\TraitMediaType;

class Type_Application_yaml
{
    use TraitMediaType;

    /**
     * @reference [YAML][RFC 9512]
     */
    const DESCRIPTION = 'application/yaml';
}