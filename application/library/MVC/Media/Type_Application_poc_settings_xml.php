<?php
/**
 * Type_Application_poc_settings_xml.php
 * @package Emvicy
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <emvicy@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

namespace MVC\Media;

use MVC\MVCTrait\TraitMediaType;

class Type_Application_poc_settings_xml
{
    use TraitMediaType;

    /**
     * @reference [RFC 4354]
     */
    const DESCRIPTION = 'application/poc-settings+xml';
}