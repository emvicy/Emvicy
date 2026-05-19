<?php
/**
 * Type_Application_syslog_msg.php
 * @package Emvicy
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <emvicy@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

namespace MVC\Media;

use MVC\MVCTrait\TraitMediaType;

class Type_Application_syslog_msg
{
    use TraitMediaType;

    /**
     * @reference [Stephen_Berard][6]
     */
    const DESCRIPTION = 'application/syslog-msg';
}