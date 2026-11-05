<?php
/**
 * Type_Application_xfdf.php
 * @package Emvicy
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <emvicy@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

namespace MVC\Media;

use MVC\MVCTrait\TraitMediaType;

class Type_Application_xfdf
{
    use TraitMediaType;

    /**
     * @reference [ISO-TC_171-SC_2]; [Betsy_Fanning]
     */
    const DESCRIPTION = 'application/xfdf';
}