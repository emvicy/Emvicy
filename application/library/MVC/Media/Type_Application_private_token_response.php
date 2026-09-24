<?php
/**
 * Type_Application_private_token_response.php
 * @package Emvicy
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <emvicy@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

namespace MVC\Media;

use MVC\MVCTrait\TraitMediaType;

class Type_Application_private_token_response
{
    use TraitMediaType;

    /**
     * @reference [RFC 9578]
     */
    const DESCRIPTION = 'application/private-token-response';
}