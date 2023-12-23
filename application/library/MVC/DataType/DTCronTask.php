<?php
# 2023-12-23 14:23:57

/**
 * @name $MVCDataType
 */
namespace MVC\DataType;

use MVC\DataType\DTValue;
use MVC\MVCTrait\TraitDataType;

class DTCronTask
{
	use TraitDataType;

	public const DTHASH = '5f630a648ee6416506ea9e01b3fd0994';

	/**
	 * @required true
	 * @var string
	 */
	protected $sRoute;

	/**
	 * @required true
	 * @var int
	 */
	protected $iIntervall;

	/**
	 * @required true
	 * @var string
	 */
	protected $sStaging;

	/**
	 * @required true
	 * @var string
	 */
	protected $sCommand;

	/**
	 * @required true
	 * @var int
	 */
	protected $iPid;

	/**
	 * DTCronTask constructor.
	 * @param array $aData
	 * @throws \ReflectionException 
	 */
	public function __construct(array $aData = array())
	{
		$oDTValue = DTValue::create()->set_mValue($aData);
		$aData = $oDTValue->get_mValue();

		$this->sRoute = '';
		$this->iIntervall = 60;
		$this->sStaging = '';
		$this->sCommand = '';
		$this->iPid = 0;

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
     * @return DTCronTask
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
	public function set_sRoute(string $mValue)
	{
		$oDTValue = DTValue::create()->set_mValue($mValue); 
		$this->sRoute = (string) $oDTValue->get_mValue();

		return $this;
	}

	/**
	 * @param int $mValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_iIntervall(int $mValue)
	{
		$oDTValue = DTValue::create()->set_mValue($mValue); 
		$this->iIntervall = $oDTValue->get_mValue();

		return $this;
	}

	/**
	 * @param string $mValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_sStaging(string $mValue)
	{
		$oDTValue = DTValue::create()->set_mValue($mValue); 
		$this->sStaging = $oDTValue->get_mValue();

		return $this;
	}

	/**
	 * @param string $mValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_sCommand(string $mValue)
	{
		$oDTValue = DTValue::create()->set_mValue($mValue); 
		$this->sCommand = $oDTValue->get_mValue();

		return $this;
	}

	/**
	 * @param int $mValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_iPid(int $mValue)
	{
		$oDTValue = DTValue::create()->set_mValue($mValue); 
		$this->iPid = $oDTValue->get_mValue();

		return $this;
	}

	/**
	 * @return string
	 * @throws \ReflectionException
	 */
	public function get_sRoute() : string
	{
		$oDTValue = DTValue::create()->set_mValue($this->sRoute); 

		return $oDTValue->get_mValue();
	}

	/**
	 * @return int|null
	 * @throws \ReflectionException
	 */
	public function get_iIntervall() : ?int
	{
		$oDTValue = DTValue::create()->set_mValue($this->iIntervall); 

		return $oDTValue->get_mValue();
	}

	/**
	 * @return string|null
	 * @throws \ReflectionException
	 */
	public function get_sStaging() : ?string
	{
		$oDTValue = DTValue::create()->set_mValue($this->sStaging); 

		return $oDTValue->get_mValue();
	}

	/**
	 * @return string|null
	 * @throws \ReflectionException
	 */
	public function get_sCommand() : ?string
	{
		$oDTValue = DTValue::create()->set_mValue($this->sCommand); 

		return $oDTValue->get_mValue();
	}

	/**
	 * @return int|null
	 * @throws \ReflectionException
	 */
	public function get_iPid() : ?int
	{
		$oDTValue = DTValue::create()->set_mValue($this->iPid); 

		return $oDTValue->get_mValue();
	}

	/**
	 * @return string
	 */
	public static function getPropertyName_sRoute()
	{
        return 'sRoute';
	}

	/**
	 * @return string
	 */
	public static function getPropertyName_iIntervall()
	{
        return 'iIntervall';
	}

	/**
	 * @return string
	 */
	public static function getPropertyName_sStaging()
	{
        return 'sStaging';
	}

	/**
	 * @return string
	 */
	public static function getPropertyName_sCommand()
	{
        return 'sCommand';
	}

	/**
	 * @return string
	 */
	public static function getPropertyName_iPid()
	{
        return 'iPid';
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
