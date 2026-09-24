<?php
/**
 * Type_Application_xcon_conference_info_diff_xml.php
 * @package Emvicy
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <emvicy@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

namespace MVC\Media;

use MVC\MVCTrait\TraitMediaType;

class Type_Application_xcon_conference_info_diff_xml
{
    use TraitMediaType;

    /**
     * @reference [RFC 6502]
     */
    const DESCRIPTION = 'application/xcon-conference-info-diff+xml';
}