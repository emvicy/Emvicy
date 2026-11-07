<?php
/**
 * Type_Application_voucher_cms_json.php
 * @package Emvicy
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <emvicy@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

namespace MVC\Media;

use MVC\MVCTrait\TraitMediaType;

class Type_Application_voucher_cms_json
{
    use TraitMediaType;

    /**
     * @reference [RFC-ietf-anima-rfc8366bis-39]
     */
    const DESCRIPTION = 'application/voucher-cms+json';
}