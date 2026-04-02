<?php
/**
 * Type_Application_vnd_uic_dosipas_v1.php
 * @package Emvicy
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <emvicy@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

namespace MVC\Media;

use MVC\MVCTrait\TraitMediaType;

class Type_Application_vnd_uic_dosipas_v1
{
    use TraitMediaType;

    /**
     * @reference [Union_Internationale_des_Chemins_de_fer]
     */
    const DESCRIPTION = 'application/vnd.uic.dosipas.v1';
}