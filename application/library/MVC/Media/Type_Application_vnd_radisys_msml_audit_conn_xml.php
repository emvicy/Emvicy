<?php
/**
 * Type_Application_vnd_radisys_msml_audit_conn_xml.php
 * @package Emvicy
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <emvicy@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

namespace MVC\Media;

use MVC\MVCTrait\TraitMediaType;

class Type_Application_vnd_radisys_msml_audit_conn_xml
{
    use TraitMediaType;

    /**
     * @reference [RFC 5707]
     */
    const DESCRIPTION = 'application/vnd.radisys.msml-audit-conn+xml';
}