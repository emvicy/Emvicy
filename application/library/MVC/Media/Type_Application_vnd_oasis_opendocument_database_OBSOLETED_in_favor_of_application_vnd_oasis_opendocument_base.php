<?php
/**
 * Type_Application_vnd_oasis_opendocument_database_OBSOLETED_in_favor_of_application_vnd_oasis_opendocument_base.php
 * @package Emvicy
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <emvicy@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

namespace MVC\Media;

use MVC\MVCTrait\TraitMediaType;

class Type_Application_vnd_oasis_opendocument_database_OBSOLETED_in_favor_of_application_vnd_oasis_opendocument_base
{
    use TraitMediaType;

    /**
     * @reference [OASIS_TC_Admin]; [OASIS]
	 * @deprecated OBSOLETED in favor of application/vndoasisopendocumentbase
     */
    const DESCRIPTION = 'application/vnd.oasis.opendocument.database';
}