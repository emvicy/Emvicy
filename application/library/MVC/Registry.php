<?php
/**
 * Registry.php
 *
 * @package Emvicy
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <emvicy@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

namespace MVC;

use ErrorException;

/**
 * Registry
 */
class Registry
{
	/**
	 * Registry object provides storage for shared objects.
	 * @var \MVC\Registry|null
	 */
    protected static ?Registry $_oRegistry = null;

	/**
	 * Storage
	 * @var array
	 */
    protected static array $_aStorage = array();

	protected function __construct()
	{
		;
	}

	/**
	 * Singleton instance
	 * @return \MVC\Registry
	 */
	public static function getInstance() : Registry
	{
		if (null === self::$_oRegistry)
		{
			self::$_oRegistry = new self ();
		}

		return self::$_oRegistry;
	}

	/**
	 * prevent any cloning
     * @return void
     */
	private function __clone() : void
	{
		;
	}

	/**
	 * Unset the default registry instance.
	 * Primarily used in tearDown() in unit tests.
	 * @return void
	 */
	public static function _unsetInstance() : void
	{
		self::$_oRegistry = null;
	}

	/**
	 * gets a value by its key
     * @param string $sIndex
     * @return mixed
     * @throws \ReflectionException
     */
	public static function get(string $sIndex = '') : mixed
	{
		if (!array_key_exists ($sIndex, self::$_aStorage))
		{
            $aDebug = debug_backtrace(limit: 1);
            $sMsg = "Registry Key unknown. No entry is registered for key '$sIndex'."
                . ' ' . $aDebug[0]['file']
                . ', ' . $aDebug[0]['line']
            ;

            Error::exception(new ErrorException ($sMsg, 0, E_USER_ERROR, __FILE__, __LINE__));
		}

		return (self::$_aStorage[$sIndex] ?? null);
	}

    /**
     * gets a value by its key and deletes the entry afterward
     * @param string $sIndex
     * @return mixed
     * @throws \ReflectionException
     */
    public static function take(string $sIndex = '') : mixed
    {
        $mValue = self::get($sIndex);
        self::delete($sIndex);

        return $mValue;
    }

	/**
	 * saves a key/value pair to registry storage
     * @param string $sIndex index of storage
     * @param mixed  $mValue value to be set
     * @return void
     */
	public static function set(string $sIndex = '', mixed $mValue = null) : void
	{
		self::$_aStorage[$sIndex] = $mValue;
	}

    /**
     * deletes a variable in registry
     * @param string $sIndex
     * @return bool
     */
    public static function delete(string $sIndex = '') : bool
    {
        if (false === self::isRegistered($sIndex))
        {
            return false;
        }

        self::$_aStorage[$sIndex] = null;
        unset(self::$_aStorage[$sIndex]);

        return true;
    }

	/**
	 * gets the storage array
     * @return array
     */
	public static function getStorageArray() : array
	{
		return self::$_aStorage;
	}

    /**
     * sets the storage array
     * @param array $aStorage
     * @return void
     */
    public static function setStorageArray(array $aStorage) :void
    {
        self::$_aStorage = $aStorage;
    }
	
	/**
	 * Returns true if the $sIndex is a named value in the registry,
	 * or FALSE if $sIndex was not found in the registry.
     * @param string $sIndex
     * @return bool
     */
	public static function isRegistered(string $sIndex = '') : bool
	{
		if (null === self::getInstance())
		{
			return false;
		}

		return array_key_exists($sIndex, self::$_aStorage);
	}
}