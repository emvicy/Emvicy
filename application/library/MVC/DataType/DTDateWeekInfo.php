<?php

/**
 * @name $MVCDataType
 */
namespace MVC\DataType;

use MVC\DataType\DTValue;
use MVC\MVCTrait\TraitDataType;

class DTDateWeekInfo
{
	use TraitDataType;

	public const DTHASH = '143792a9fbeb1571885ce28e51ee6ad9';

	/**
	 * @required true
	 * @var int
	 */
	protected $year;

	/**
	 * @required true
	 * @var int
	 */
	protected $week;

	/**
	 * @required true
	 * @var string
	 */
	protected $dateStart;

	/**
	 * @required true
	 * @var string
	 */
	protected $dateEnd;

	/**
	 * @required true
	 * @var string
	 */
	protected $dayStart;

	/**
	 * @required true
	 * @var string
	 */
	protected $dayEnd;

	/**
	 * DTDateWeekInfo constructor.
	 * @param DTValue $oDTValue
	 * @throws \ReflectionException 
	 */
	protected function __construct(DTValue $oDTValue)
	{
		\MVC\Event::run('DTDateWeekInfo.__construct.before', $oDTValue);
		$aData = $oDTValue->get_mValue();
		$this->year = 0;
		$this->week = 0;
		$this->dateStart = '';
		$this->dateEnd = '';
		$this->dayStart = '';
		$this->dayEnd = '';
		$this->setProperties($oDTValue);

		$oDTValue = DTValue::create()->set_mValue($aData); 
		\MVC\Event::run('DTDateWeekInfo.__construct.after', $oDTValue);
	}

    /**
     * @param array|null $aData
     * @return DTDateWeekInfo
     * @throws \ReflectionException
     */
    public static function create(?array $aData = array())
    {            
        (null === $aData) ? $aData = array() : false;
        $oDTValue = DTValue::create()->set_mValue($aData);
		\MVC\Event::run('DTDateWeekInfo.create.before', $oDTValue);
		$oObject = new self($oDTValue);
        $oDTValue = DTValue::create()->set_mValue($oObject); \MVC\Event::run('DTDateWeekInfo.create.after', $oDTValue);

        return $oDTValue->get_mValue();
    }

	/**
	 * @param int $mValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_year(int $mValue)
	{
		$oDTValue = DTValue::create()->set_mValue($mValue); 
		\MVC\Event::run('DTDateWeekInfo.set_year.before', $oDTValue);
		$this->year = (int) $oDTValue->get_mValue();

		return $this;
	}

	/**
	 * @param int $mValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_week(int $mValue)
	{
		$oDTValue = DTValue::create()->set_mValue($mValue); 
		\MVC\Event::run('DTDateWeekInfo.set_week.before', $oDTValue);
		$this->week = (int) $oDTValue->get_mValue();

		return $this;
	}

	/**
	 * @param string $mValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_dateStart(string $mValue)
	{
		$oDTValue = DTValue::create()->set_mValue($mValue); 
		\MVC\Event::run('DTDateWeekInfo.set_dateStart.before', $oDTValue);
		$this->dateStart = (string) $oDTValue->get_mValue();

		return $this;
	}

	/**
	 * @param string $mValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_dateEnd(string $mValue)
	{
		$oDTValue = DTValue::create()->set_mValue($mValue); 
		\MVC\Event::run('DTDateWeekInfo.set_dateEnd.before', $oDTValue);
		$this->dateEnd = (string) $oDTValue->get_mValue();

		return $this;
	}

	/**
	 * @param string $mValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_dayStart(string $mValue)
	{
		$oDTValue = DTValue::create()->set_mValue($mValue); 
		\MVC\Event::run('DTDateWeekInfo.set_dayStart.before', $oDTValue);
		$this->dayStart = (string) $oDTValue->get_mValue();

		return $this;
	}

	/**
	 * @param string $mValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_dayEnd(string $mValue)
	{
		$oDTValue = DTValue::create()->set_mValue($mValue); 
		\MVC\Event::run('DTDateWeekInfo.set_dayEnd.before', $oDTValue);
		$this->dayEnd = (string) $oDTValue->get_mValue();

		return $this;
	}

	/**
	 * @return int
	 * @throws \ReflectionException
	 */
	public function get_year() : int
	{
		$oDTValue = DTValue::create()->set_mValue($this->year); 
		\MVC\Event::run('DTDateWeekInfo.get_year.before', $oDTValue);

		return $oDTValue->get_mValue();
	}

	/**
	 * @return int
	 * @throws \ReflectionException
	 */
	public function get_week() : int
	{
		$oDTValue = DTValue::create()->set_mValue($this->week); 
		\MVC\Event::run('DTDateWeekInfo.get_week.before', $oDTValue);

		return $oDTValue->get_mValue();
	}

	/**
	 * @return string
	 * @throws \ReflectionException
	 */
	public function get_dateStart() : string
	{
		$oDTValue = DTValue::create()->set_mValue($this->dateStart); 
		\MVC\Event::run('DTDateWeekInfo.get_dateStart.before', $oDTValue);

		return $oDTValue->get_mValue();
	}

	/**
	 * @return string
	 * @throws \ReflectionException
	 */
	public function get_dateEnd() : string
	{
		$oDTValue = DTValue::create()->set_mValue($this->dateEnd); 
		\MVC\Event::run('DTDateWeekInfo.get_dateEnd.before', $oDTValue);

		return $oDTValue->get_mValue();
	}

	/**
	 * @return string
	 * @throws \ReflectionException
	 */
	public function get_dayStart() : string
	{
		$oDTValue = DTValue::create()->set_mValue($this->dayStart); 
		\MVC\Event::run('DTDateWeekInfo.get_dayStart.before', $oDTValue);

		return $oDTValue->get_mValue();
	}

	/**
	 * @return string
	 * @throws \ReflectionException
	 */
	public function get_dayEnd() : string
	{
		$oDTValue = DTValue::create()->set_mValue($this->dayEnd); 
		\MVC\Event::run('DTDateWeekInfo.get_dayEnd.before', $oDTValue);

		return $oDTValue->get_mValue();
	}

	/**
	 * @return string
	 */
	public static function getPropertyName_year()
	{
        return 'year';
	}

	/**
	 * @return string
	 */
	public static function getPropertyName_week()
	{
        return 'week';
	}

	/**
	 * @return string
	 */
	public static function getPropertyName_dateStart()
	{
        return 'dateStart';
	}

	/**
	 * @return string
	 */
	public static function getPropertyName_dateEnd()
	{
        return 'dateEnd';
	}

	/**
	 * @return string
	 */
	public static function getPropertyName_dayStart()
	{
        return 'dayStart';
	}

	/**
	 * @return string
	 */
	public static function getPropertyName_dayEnd()
	{
        return 'dayEnd';
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
        return json_encode(\MVC\Convert::objectToArray($this));
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
