<?php
/**
 * Type_Application_vnd_oma_scidm_messages_xml.php
 * @package Emvicy
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <emvicy@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

namespace MVC\Media;

use MVC\MVCTrait\TraitMediaType;

class Type_Application_vnd_oma_scidm_messages_xml
{
    use TraitMediaType;

    /**
     * @reference [Wenjun_Zeng]; [Open_Mobile_Naming_Authority]
     */
    const DESCRIPTION = 'application/vnd.oma.scidm.messages+xml';
}