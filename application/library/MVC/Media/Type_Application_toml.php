<?php
/**
 * Type_Application_toml.php
 * @package Emvicy
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <emvicy@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

namespace MVC\Media;

use MVC\MVCTrait\TraitMediaType;

class Type_Application_toml
{
    use TraitMediaType;

    /**
     * @reference [Ben_van_Hartingsveldt][https://github.com/toml-lang/toml/issues/870][2]
     */
    const DESCRIPTION = 'application/toml';
}