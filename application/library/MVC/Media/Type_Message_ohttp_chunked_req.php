<?php
/**
 * Type_Message_ohttp_chunked_req.php
 * @package Emvicy
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <emvicy@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

namespace MVC\Media;

use MVC\MVCTrait\TraitMediaType;

class Type_Message_ohttp_chunked_req
{
    use TraitMediaType;

    /**
     * @reference [RFC-ietf-ohai-chunked-ohttp-08]
     */
    const DESCRIPTION = 'message/ohttp-chunked-req';
}