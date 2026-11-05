<?php
/**
 * Type_Application_efi.php
 * @package Emvicy
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <emvicy@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

namespace MVC\Media;

use MVC\MVCTrait\TraitMediaType;

class Type_Application_efi
{
    use TraitMediaType;

    /**
     * @reference [UEFI_Forum]; [Samer_El-Haj-Mahmoud]
     */
    const DESCRIPTION = 'application/efi';
}