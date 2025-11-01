<?php
/**
 * Type_Application_trust_mark_jwt.php
 * @package Emvicy
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <emvicy@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

namespace MVC\Media;

use MVC\MVCTrait\TraitMediaType;

class Type_Application_trust_mark_jwt
{
    use TraitMediaType;

    /**
     * @reference [OpenID_Foundation_Artifact_Binding_WG]
     */
    const DESCRIPTION = 'application/trust-mark+jwt';
}