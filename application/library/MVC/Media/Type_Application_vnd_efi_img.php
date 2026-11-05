<?php
/**
 * Type_Application_vnd_efi_img.php
 * @package Emvicy
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <emvicy@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

namespace MVC\Media;

use MVC\MVCTrait\TraitMediaType;

class Type_Application_vnd_efi_img
{
    use TraitMediaType;

    /**
     * @reference [UEFI_Forum]; [Fu_Siyuan]
     */
    const DESCRIPTION = 'application/vnd.efi.img';
}