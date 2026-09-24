<?php
/**
 * Type_Application_dialog_info_xml.php
 * @package Emvicy
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <emvicy@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

namespace MVC\Media;

use MVC\MVCTrait\TraitMediaType;

class Type_Application_dialog_info_xml
{
    use TraitMediaType;

    /**
     * @reference [RFC 4235]
     */
    const DESCRIPTION = 'application/dialog-info+xml';
}