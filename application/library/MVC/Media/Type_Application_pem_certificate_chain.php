<?php
/**
 * Type_Application_pem_certificate_chain.php
 * @package Emvicy
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <emvicy@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

namespace MVC\Media;

use MVC\MVCTrait\TraitMediaType;

class Type_Application_pem_certificate_chain
{
    use TraitMediaType;

    /**
     * @reference [RFC 8555]
     */
    const DESCRIPTION = 'application/pem-certificate-chain';
}