<?php
# 2023-12-03 06:59:44

/**
 * @name $MVCDataType
 */
namespace MVC\DataType;

use MVC\DataType\DTValue;
use MVC\MVCTrait\TraitDataType;

class DTDBWhere
{
	use TraitDataType;

	public const DTHASH = '76e4bcc0ad9c45b7f22b899c6676c083';

	/**
	 * @required true
	 * @var string
	 */
	protected $sKey;

	/**
	 * @required true
	 * @var string
	 */
	protected $sRelation;

	/**
	 * @required true
	 * @var string
	 */
	protected $sValue;

	/**
	 * DTDBWhere constructor.
	 * @param array $aData
	 * @throws \ReflectionException 
	 */
	public function __construct(array $aData = array())
	{
		$oDTValue = DTValue::create()->set_mValue($aData);
		$aData = $oDTValue->get_mValue();

		$this->sKey = '';
		$this->sRelation = "=";
		$this->sValue = '';

		foreach ($aData as $sKey => $mValue)
		{
			$sMethod = 'set_' . $sKey;

			if (method_exists($this, $sMethod))
			{
				$this->$sMethod($mValue);
			}
		}

		$oDTValue = DTValue::create()->set_mValue($aData); 
	}

    /**
     * @param array $aData
     * @return DTDBWhere
     * @throws \ReflectionException
     */
    public static function create(array $aData = array())
    {
        $oDTValue = DTValue::create()->set_mValue($aData);
		$oObject = new self($oDTValue->get_mValue());
        $oDTValue = DTValue::create()->set_mValue($oObject); 

        return $oDTValue->get_mValue();
    }

	/**
	 * @param string $mValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_sKey(string $mValue)
	{
		$oDTValue = DTValue::create()->set_mValue($mValue); 
		$this->sKey = (string) $oDTValue->get_mValue();

		return $this;
	}

	/**
	 * @param string $mValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_sRelation(string $mValue)
	{
		$oDTValue = DTValue::create()->set_mValue($mValue); 
		$this->sRelation = (string) $oDTValue->get_mValue();

		return $this;
	}

	/**
	 * @param string $mValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_sValue(string $mValue)
	{
		$oDTValue = DTValue::create()->set_mValue($mValue); 
		$this->sValue = (string) $oDTValue->get_mValue();

		return $this;
	}

	/**
	 * @return string
	 * @throws \ReflectionException
	 */
	public function get_sKey() : string
	{
		$oDTValue = DTValue::create()->set_mValue($this->sKey); 

		return $oDTValue->get_mValue();
	}

	/**
	 * @return string
	 * @throws \ReflectionException
	 */
	public function get_sRelation() : string
	{
		$oDTValue = DTValue::create()->set_mValue($this->sRelation); 

		return $oDTValue->get_mValue();
	}

	/**
	 * @return string
	 * @throws \ReflectionException
	 */
	public function get_sValue() : string
	{
		$oDTValue = DTValue::create()->set_mValue($this->sValue); 

		return $oDTValue->get_mValue();
	}

	/**
	 * @return string
	 */
	public static function getPropertyName_sKey()
	{
        return 'sKey';
	}

	/**
	 * @return string
	 */
	public static function getPropertyName_sRelation()
	{
        return 'sRelation';
	}

	/**
	 * @return string
	 */
	public static function getPropertyName_sValue()
	{
        return 'sValue';
	}

	/**
	 * @return false|string JSON
	 */
	public function __toString()
	{
        return $this->getPropertyJson();
	}

	/**
	 * @return false|string
	 */
	public function getPropertyJson()
	{
        return json_encode($this->getPropertyArray());
	}

	/**
	 * @return array
	 */
	public function getPropertyArray()
	{
        return get_object_vars($this);
	}

	/**
	 * @return array
	 * @throws \ReflectionException
	 */
	public function getConstantArray()
	{
		$oReflectionClass = new \ReflectionClass($this);
		$aConstant = $oReflectionClass->getConstants();

		return $aConstant;
	}

	/**
	 * @return $this
	 */
	public function flushProperties()
	{
		foreach ($this->getPropertyArray() as $sKey => $mValue)
		{
			$sMethod = 'set_' . $sKey;

			if (method_exists($this, $sMethod)) 
			{
				$this->$sMethod('');
			}
		}

		return $this;
	}

}
