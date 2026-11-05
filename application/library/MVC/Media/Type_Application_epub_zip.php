<?php
/**
 * Type_Application_epub_zip.php
 * @package Emvicy
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <emvicy@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

namespace MVC\Media;

use MVC\MVCTrait\TraitMediaType;

class Type_Application_epub_zip
{
    use TraitMediaType;

    /**
     * @reference [W3C]; [EPUB_3_WG]
     */
    const DESCRIPTION = 'application/epub+zip';
}