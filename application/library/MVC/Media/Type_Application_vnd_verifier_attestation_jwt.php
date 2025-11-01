<?php
/**
 * Type_Application_vnd_verifier_attestation_jwt.php
 * @package Emvicy
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <emvicy@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

namespace MVC\Media;

use MVC\MVCTrait\TraitMediaType;

class Type_Application_vnd_verifier_attestation_jwt
{
    use TraitMediaType;

    /**
     * @reference [OpenID_Foundation_Digital_Credentials_Protocols_WG][Oliver_Terbu]
     */
    const DESCRIPTION = 'application/vnd.verifier-attestation+jwt';
}