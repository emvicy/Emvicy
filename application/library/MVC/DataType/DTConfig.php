<?php

/**
 * @name $MVCDataType
 */
namespace MVC\DataType;

use MVC\DataType\DTValue;
use MVC\MVCTrait\TraitDataType;

class DTConfig
{
	use TraitDataType;

	public const DTHASH = '9d8e43f72f729aba3d2e64cf7237f375';

	/**
	 * @required true
	 * @var string
	 */
	protected $dir;

	/**
	 * @required true
	 * @var bool
	 */
	protected $unlinkDir;

	/**
	 * @required true
	 * @var \MVC\DataType\DTClass[]
	 */
	protected $class;

	/**
	 * @required true
	 * @var bool
	 */
	protected $createEvents;

	/**
	 * DTConfig constructor.
	 * @param DTValue $oDTValue
	 * @throws \ReflectionException 
	 */
	protected function __construct(DTValue $oDTValue)
	{
		\MVC\Event::run('DTConfig.__construct.before', $oDTValue);
		$aData = $oDTValue->get_mValue();
		$this->dir = '';
		$this->unlinkDir = false;
		$this->class = array();
		$this->createEvents = true;
		$this->setProperties($oDTValue);

		$oDTValue = DTValue::create()->set_mValue($aData); 
		\MVC\Event::run('DTConfig.__construct.after', $oDTValue);
	}

    /**
     * @param array|null $aData
     * @return DTConfig
     * @throws \ReflectionException
     */
    public static function create(?array $aData = array())
    {            
        (null === $aData) ? $aData = array() : false;
        $oDTValue = DTValue::create()->set_mValue($aData);
		\MVC\Event::run('DTConfig.create.before', $oDTValue);
		$oObject = new self($oDTValue);
        $oDTValue = DTValue::create()->set_mValue($oObject); \MVC\Event::run('DTConfig.create.after', $oDTValue);

        return $oDTValue->get_mValue();
    }

    /**
     * @deprecated use instead: add_class()
     * @param \MVC\DataType\DTClass $oDTClass
     * @return $this
     * @throws \ReflectionException
     */
    public function add_DTClass(\MVC\DataType\DTClass $oDTClass)
    {
        $oDTValue = DTValue::create()->set_mValue($oDTClass); \MVC\Event::RUN ('DTConfig.add_DTClass.before', $oDTValue);
        $this->add_class($oDTValue->get_mValue());

        return $this;
    }

	/**
	 * @param string $mValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_dir(string $mValue)
	{
		$oDTValue = DTValue::create()->set_mValue($mValue); 
		\MVC\Event::run('DTConfig.set_dir.before', $oDTValue);
		$this->dir =  (string) $oDTValue->get_mValue() ;

		return $this;
	}

	/**
	 * @param bool $mValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_unlinkDir(bool $mValue)
	{
		$oDTValue = DTValue::create()->set_mValue($mValue); 
		\MVC\Event::run('DTConfig.set_unlinkDir.before', $oDTValue);
		$this->unlinkDir =  (bool) $oDTValue->get_mValue() ;

		return $this;
	}

    /**
     * @param array  $mValue
     * @return $this
     * @throws \ReflectionException
     */
    public function set_class(array $aValue)
    {
        $oDTValue = DTValue::create()->set_mValue($aValue); \MVC\Event::RUN ('DTConfig.set_class.before', $oDTValue);
        $aValue = $oDTValue->get_mValue();

        foreach ($aValue as $mKey => $aData)
        {
            if (false === ($aData instanceof \MVC\DataType\DTClass))
            {
                $aValue[$mKey] = \MVC\DataType\DTClass::create($aData);
            }
        }

        $this->class = $aValue;

        return $this;
    }

    /**
     * @param \MVC\DataType\DTClass $oDTClass
     * @return $this
     * @throws \ReflectionException
     */
	public function add_class(\MVC\DataType\DTClass $oDTClass)
	{
		$oDTValue = DTValue::create()->set_mValue($oDTClass);
		\MVC\Event::run('DTConfig.add_class.before', $oDTValue);

		$this->class[] = $oDTValue->get_mValue();

		return $this;
	}

	/**
	 * @param bool $mValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_createEvents(bool $mValue)
	{
		$oDTValue = DTValue::create()->set_mValue($mValue); 
		\MVC\Event::run('DTConfig.set_createEvents.before', $oDTValue);
		$this->createEvents =  (bool) $oDTValue->get_mValue() ;

		return $this;
	}

	/**
	 * @return string
	 * @throws \ReflectionException
	 */
	public function get_dir() : string
	{
		$oDTValue = DTValue::create()->set_mValue($this->dir); 
		\MVC\Event::run('DTConfig.get_dir.before', $oDTValue);

		return $oDTValue->get_mValue();
	}

	/**
	 * @return bool
	 * @throws \ReflectionException
	 */
	public function get_unlinkDir() : bool
	{
		$oDTValue = DTValue::create()->set_mValue($this->unlinkDir); 
		\MVC\Event::run('DTConfig.get_unlinkDir.before', $oDTValue);

		return $oDTValue->get_mValue();
	}

	/**
	 * @return \MVC\DataType\DTClass[]
	 * @throws \ReflectionException
	 */
	public function get_class() : array
	{
		$oDTValue = DTValue::create()->set_mValue($this->class); 
		\MVC\Event::run('DTConfig.get_class.before', $oDTValue);

		return $oDTValue->get_mValue();
	}

	/**
	 * @return bool
	 * @throws \ReflectionException
	 */
	public function get_createEvents() : bool
	{
		$oDTValue = DTValue::create()->set_mValue($this->createEvents); 
		\MVC\Event::run('DTConfig.get_createEvents.before', $oDTValue);

		return $oDTValue->get_mValue();
	}

	/**
	 * @return string
	 */
	public static function getPropertyName_dir()
	{
        return 'dir';
	}

	/**
	 * @return string
	 */
	public static function getPropertyName_unlinkDir()
	{
        return 'unlinkDir';
	}

	/**
	 * @return string
	 */
	public static function getPropertyName_class()
	{
        return 'class';
	}

	/**
	 * @return string
	 */
	public static function getPropertyName_createEvents()
	{
        return 'createEvents';
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
