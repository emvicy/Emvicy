<?php
/**
 * Type_Application_cdmi_domain.php
 * @package Emvicy
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <emvicy@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

namespace MVC\Media;

use MVC\MVCTrait\TraitMediaType;

class Type_Application_cdmi_domain
{
    use TraitMediaType;

    /**
     * @reference [RFC 6208]
     */
    const DESCRIPTION = 'application/cdmi-domain';
}