<?php
/**
 * Type_Application_vnd_tcpdump_pcap.php
 * @package Emvicy
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <emvicy@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

namespace MVC\Media;

use MVC\MVCTrait\TraitMediaType;

class Type_Application_vnd_tcpdump_pcap
{
    use TraitMediaType;

    /**
     * @reference [Guy_Harris]; [Glen_Turner]
     */
    const DESCRIPTION = 'application/vnd.tcpdump.pcap';
}