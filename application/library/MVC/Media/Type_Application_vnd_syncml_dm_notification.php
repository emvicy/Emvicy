<?php
/**
 * Type_Application_vnd_syncml_dm_notification.php
 * @package Emvicy
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <emvicy@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

namespace MVC\Media;

use MVC\MVCTrait\TraitMediaType;

class Type_Application_vnd_syncml_dm_notification
{
    use TraitMediaType;

    /**
     * @reference [Peter_Thompson]; [OMA-DM_Work_Group]
     */
    const DESCRIPTION = 'application/vnd.syncml.dm.notification';
}