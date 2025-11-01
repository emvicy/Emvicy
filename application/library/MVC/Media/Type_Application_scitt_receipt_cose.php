<?php
/**
 * Type_Application_scitt_receipt_cose.php
 * @package Emvicy
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <emvicy@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

namespace MVC\Media;

use MVC\MVCTrait\TraitMediaType;

class Type_Application_scitt_receipt_cose
{
    use TraitMediaType;

    /**
     * @reference [RFC-ietf-scitt-architecture-21]
     */
    const DESCRIPTION = 'application/scitt-receipt+cose';
}