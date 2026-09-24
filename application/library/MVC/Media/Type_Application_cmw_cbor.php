<?php
/**
 * Type_Application_cmw_cbor.php
 * @package Emvicy
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <emvicy@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

namespace MVC\Media;

use MVC\MVCTrait\TraitMediaType;

class Type_Application_cmw_cbor
{
    use TraitMediaType;

    /**
     * @reference [RFC9999, Sections 3.1, 3.2, 3.3]
     */
    const DESCRIPTION = 'application/cmw+cbor';
}