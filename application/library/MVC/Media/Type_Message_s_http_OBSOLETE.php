<?php
/**
 * Type_Message_s_http_OBSOLETE.php
 * @package Emvicy
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <emvicy@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

namespace MVC\Media;

use MVC\MVCTrait\TraitMediaType;

class Type_Message_s_http_OBSOLETE
{
    use TraitMediaType;

    /**
     * @reference [RFC 2660][Status change of HTTP experiments to Historic]
	 * @deprecated OBSOLETE
     */
    const DESCRIPTION = 'message/s-http';
}