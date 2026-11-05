<?php
/**
 * Type_Model_obj.php
 * @package Emvicy
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <emvicy@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

namespace MVC\Media;

use MVC\MVCTrait\TraitMediaType;

class Type_Model_obj
{
    use TraitMediaType;

    /**
     * @reference [DICOM_Standard_Committee]; [DICOM_WG_17]; [Carolyn_Hull]
     */
    const DESCRIPTION = 'model/obj';
}