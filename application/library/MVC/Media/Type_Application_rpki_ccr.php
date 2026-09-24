<?php
/**
 * Type_Application_rpki_ccr.php
 * @package Emvicy
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <emvicy@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

namespace MVC\Media;

use MVC\MVCTrait\TraitMediaType;

class Type_Application_rpki_ccr
{
    use TraitMediaType;

    /**
     * @reference [RFC-ietf-sidrops-rpki-ccr-11]
     */
    const DESCRIPTION = 'application/rpki-ccr';
}