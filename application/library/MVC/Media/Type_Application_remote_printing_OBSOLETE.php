<?php
/**
 * Type_Application_remote_printing_OBSOLETE.php
 * @package Emvicy
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <emvicy@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

namespace MVC\Media;

use MVC\MVCTrait\TraitMediaType;

class Type_Application_remote_printing_OBSOLETE
{
    use TraitMediaType;

    /**
     * @reference [RFC 1486][Marshall_Rose][Moving TPC.INT and NSAP.INT infrastructure domains to historic]
	 * @deprecated OBSOLETE
     */
    const DESCRIPTION = 'application/remote-printing';
}