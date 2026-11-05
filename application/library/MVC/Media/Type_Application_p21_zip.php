<?php
/**
 * Type_Application_p21_zip.php
 * @package Emvicy
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <emvicy@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

namespace MVC\Media;

use MVC\MVCTrait\TraitMediaType;

class Type_Application_p21_zip
{
    use TraitMediaType;

    /**
     * @reference [ISO-TC_184-SC_4]; [Dana_Tripp]
     */
    const DESCRIPTION = 'application/p21+zip';
}