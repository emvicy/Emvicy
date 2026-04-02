<?php
/**
 * Type_Application_cmw_jws.php
 * @package Emvicy
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <emvicy@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

namespace MVC\Media;

use MVC\MVCTrait\TraitMediaType;

class Type_Application_cmw_jws
{
    use TraitMediaType;

    /**
     * @reference [RFC-ietf-rats-msg-wrap-22]
     */
    const DESCRIPTION = 'application/cmw+jws';
}