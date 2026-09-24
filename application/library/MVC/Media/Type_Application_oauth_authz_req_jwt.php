<?php
/**
 * Type_Application_oauth_authz_req_jwt.php
 * @package Emvicy
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <emvicy@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

namespace MVC\Media;

use MVC\MVCTrait\TraitMediaType;

class Type_Application_oauth_authz_req_jwt
{
    use TraitMediaType;

    /**
     * @reference [RFC 9101]
     */
    const DESCRIPTION = 'application/oauth-authz-req+jwt';
}