<?php
/**
 * Type_Application_vnd_oms_cellular_cose_content_cbor.php
 * @package Emvicy
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <emvicy@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

namespace MVC\Media;

use MVC\MVCTrait\TraitMediaType;

class Type_Application_vnd_oms_cellular_cose_content_cbor
{
    use TraitMediaType;

    /**
     * @reference [Torben_Markussen][OMS-Group_e._V.]
     */
    const DESCRIPTION = 'application/vnd.oms.cellular-cose-content+cbor';
}