<?php
/**
 * Controller.php
 *
 * @package Emvicy
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <emvicy@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

namespace  MVC\MVCInterface;

use MVC\DataType\DTRequestIn;
use MVC\DataType\DTRoute;

/**
 * Interface to be implemented in a Target Controller Class
 */
interface Controller
{	
	/**
	 * this method is autom. called by MVC_Application::runTargetClassPreconstruct()
	 * this methodname is noted in the config:
	 * $aConfig['MVC_METHODNAME_PRECONSTRUCT']
	 */	
	public static function __preconstruct();

    /**
     * @param \MVC\DataType\DTRequestIn $oDTRequestIn
     * @param \MVC\DataType\DTRoute     $oDTRoute
     */
	public function __construct(DTRequestIn $oDTRequestIn, DTRoute $oDTRoute);
	
	/**
	 * Destructor
	 */
	public function __destruct();
}