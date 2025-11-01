<?php
/**
 * Type_Application_vnd_3gpp_seal_data_delivery_info_cbor.php
 * @package Emvicy
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <emvicy@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

namespace MVC\Media;

use MVC\MVCTrait\TraitMediaType;

class Type_Application_vnd_3gpp_seal_data_delivery_info_cbor
{
    use TraitMediaType;

    /**
     * @reference [_3GPP]
     */
    const DESCRIPTION = 'application/vnd.3gpp.seal-data-delivery-info+cbor';
}