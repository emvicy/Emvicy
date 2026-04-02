<?php
/**
 * Type_Application_vp_sd_jwt.php
 * @package Emvicy
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <emvicy@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

namespace MVC\Media;

use MVC\MVCTrait\TraitMediaType;

class Type_Application_vp_sd_jwt
{
    use TraitMediaType;

    /**
     * @reference [W3C_Verifiable_Credentials_WG][Ivan_Herman]
     */
    const DESCRIPTION = 'application/vp+sd-jwt';
}