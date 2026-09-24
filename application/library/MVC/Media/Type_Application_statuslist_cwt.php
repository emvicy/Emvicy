<?php
/**
 * Type_Application_statuslist_cwt.php
 * @package Emvicy
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <emvicy@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

namespace MVC\Media;

use MVC\MVCTrait\TraitMediaType;

class Type_Application_statuslist_cwt
{
    use TraitMediaType;

    /**
     * @reference [RFC-ietf-oauth-status-list-21]
     */
    const DESCRIPTION = 'application/statuslist+cwt';
}