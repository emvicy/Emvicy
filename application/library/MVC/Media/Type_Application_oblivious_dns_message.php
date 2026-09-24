<?php
/**
 * Type_Application_oblivious_dns_message.php
 * @package Emvicy
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <emvicy@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

namespace MVC\Media;

use MVC\MVCTrait\TraitMediaType;

class Type_Application_oblivious_dns_message
{
    use TraitMediaType;

    /**
     * @reference [RFC 9230]
     */
    const DESCRIPTION = 'application/oblivious-dns-message';
}