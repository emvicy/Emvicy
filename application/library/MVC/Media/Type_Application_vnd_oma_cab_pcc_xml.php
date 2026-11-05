<?php
/**
 * Type_Application_vnd_oma_cab_pcc_xml.php
 * @package Emvicy
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <emvicy@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

namespace MVC\Media;

use MVC\MVCTrait\TraitMediaType;

class Type_Application_vnd_oma_cab_pcc_xml
{
    use TraitMediaType;

    /**
     * @reference [Hao_Wang]; [OMA]
     */
    const DESCRIPTION = 'application/vnd.oma.cab-pcc+xml';
}