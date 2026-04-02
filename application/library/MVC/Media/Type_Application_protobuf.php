<?php
/**
 * Type_Application_protobuf.php
 * @package Emvicy
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <emvicy@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

namespace MVC\Media;

use MVC\MVCTrait\TraitMediaType;

class Type_Application_protobuf
{
    use TraitMediaType;

    /**
     * @reference [RFC-ietf-dispatch-mime-protobuf-06]
     */
    const DESCRIPTION = 'application/protobuf';
}