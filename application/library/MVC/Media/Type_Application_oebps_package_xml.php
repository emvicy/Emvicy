<?php
/**
 * Type_Application_oebps_package_xml.php
 * @package Emvicy
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <emvicy@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

namespace MVC\Media;

use MVC\MVCTrait\TraitMediaType;

class Type_Application_oebps_package_xml
{
    use TraitMediaType;

    /**
     * @reference [W3C]; [EPUB_3_WG]
     */
    const DESCRIPTION = 'application/oebps-package+xml';
}