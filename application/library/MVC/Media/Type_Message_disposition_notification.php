<?php
/**
 * Type_Message_disposition_notification.php
 * @package Emvicy
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <emvicy@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

namespace MVC\Media;

use MVC\MVCTrait\TraitMediaType;

class Type_Message_disposition_notification
{
    use TraitMediaType;

    /**
     * @reference [RFC 8098]
     */
    const DESCRIPTION = 'message/disposition-notification';
}