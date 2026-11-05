<?php
/**
 * Type_Application_urc_ressheet_xml.php
 * @package Emvicy
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <emvicy@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

namespace MVC\Media;

use MVC\MVCTrait\TraitMediaType;

class Type_Application_urc_ressheet_xml
{
    use TraitMediaType;

    /**
     * @reference [Gottfried_Zimmermann]; [ISO-IEC_JTC_1]
     */
    const DESCRIPTION = 'application/urc-ressheet+xml';
}