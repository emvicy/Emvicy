<?php
/**
 * Type_Application_timestamp_reply.php
 * @package Emvicy
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <emvicy@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

namespace MVC\Media;

use MVC\MVCTrait\TraitMediaType;

class Type_Application_timestamp_reply
{
    use TraitMediaType;

    /**
     * @reference [RFC 3161]
     */
    const DESCRIPTION = 'application/timestamp-reply';
}