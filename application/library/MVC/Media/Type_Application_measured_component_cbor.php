<?php
/**
 * Type_Application_measured_component_cbor.php
 * @package Emvicy
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <emvicy@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

namespace MVC\Media;

use MVC\MVCTrait\TraitMediaType;

class Type_Application_measured_component_cbor
{
    use TraitMediaType;

    /**
     * @reference [RFC-ietf-rats-eat-measured-component-12]
     */
    const DESCRIPTION = 'application/measured-component+cbor';
}