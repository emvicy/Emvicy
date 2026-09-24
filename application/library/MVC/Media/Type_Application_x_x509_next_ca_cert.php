<?php
/**
 * Type_Application_x_x509_next_ca_cert.php
 * @package Emvicy
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <emvicy@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

namespace MVC\Media;

use MVC\MVCTrait\TraitMediaType;

class Type_Application_x_x509_next_ca_cert
{
    use TraitMediaType;

    /**
     * @reference [RFC 8894]
     */
    const DESCRIPTION = 'application/x-x509-next-ca-cert';
}