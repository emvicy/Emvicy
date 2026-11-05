<?php
/**
 * Type_Application_provided_claims_jwt.php
 * @package Emvicy
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <emvicy@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

namespace MVC\Media;

use MVC\MVCTrait\TraitMediaType;

class Type_Application_provided_claims_jwt
{
    use TraitMediaType;

    /**
     * @reference [OpenID_Foundation_eKYC_and_IDA_WG]; [Daniel_Fett]
     */
    const DESCRIPTION = 'application/provided-claims+jwt';
}