<?php
# 2024-01-13 13:14:31

/**
 * @name $MVCDataType
 */
namespace MVC\DataType;

use MVC\DataType\DTValue;
use MVC\MVCTrait\TraitDataType;

class DTRoute
{
	use TraitDataType;

	public const DTHASH = 'cfc70fabddc3054ec76225204b328146';

	/**
	 * @required true
	 * @var string
	 */
	protected $path;

	/**
	 * @required true
	 * @var string
	 */
	protected $method;

	/**
	 * @required true
	 * @var array
	 */
	protected $methodsAssigned;

	/**
	 * @required true
	 * @var string
	 */
	protected $query;

	/**
	 * @required true
	 * @var string
	 */
	protected $class;

	/**
	 * @required true
	 * @var string
	 */
	protected $classFile;

	/**
	 * @required true
	 * @var string
	 */
	protected $module;

	/**
	 * @required true
	 * @var string
	 */
	protected $c;

	/**
	 * @required true
	 * @var string
	 */
	protected $m;

	/**
	 * @required false
	 * @var mixed
	 */
	protected $additional;

	/**
	 * @required false
	 * @var string
	 */
	protected $tag;

	/**
	 * DTRoute constructor.
	 * @param array $aData
	 * @throws \ReflectionException 
	 */
	public function __construct(array $aData = array())
	{
		$oDTValue = DTValue::create()->set_mValue($aData);
		\MVC\Event::run('DTRoute.__construct.before', $oDTValue);
		$aData = $oDTValue->get_mValue();

		$this->path = '';
		$this->method = '';
		$this->methodsAssigned = array();
		$this->query = '';
		$this->class = '';
		$this->classFile = '';
		$this->module = '';
		$this->c = '';
		$this->m = '';
		$this->additional = null;
		$this->tag = '';

		foreach ($aData as $sKey => $mValue)
		{
			$sMethod = 'set_' . $sKey;

			if (method_exists($this, $sMethod))
			{
				$this->$sMethod($mValue);
			}
		}

		$oDTValue = DTValue::create()->set_mValue($aData); \MVC\Event::run('DTRoute.__construct.after', $oDTValue);
	}

    /**
     * @param array $aData
     * @return DTRoute
     * @throws \ReflectionException
     */
    public static function create(array $aData = array())
    {
        $oDTValue = DTValue::create()->set_mValue($aData);
		\MVC\Event::run('DTRoute.create.before', $oDTValue);
		$oObject = new self($oDTValue->get_mValue());
        $oDTValue = DTValue::create()->set_mValue($oObject); \MVC\Event::run('DTRoute.create.after', $oDTValue);

        return $oDTValue->get_mValue();
    }

	/**
	 * @param string $mValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_path(string $mValue)
	{
		$oDTValue = DTValue::create()->set_mValue($mValue); 
		\MVC\Event::run('DTRoute.set_path.before', $oDTValue);
		$this->path = (string) $oDTValue->get_mValue();

		return $this;
	}

	/**
	 * @param string $mValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_method(string $mValue)
	{
		$oDTValue = DTValue::create()->set_mValue($mValue); 
		\MVC\Event::run('DTRoute.set_method.before', $oDTValue);
		$this->method = (string) $oDTValue->get_mValue();

		return $this;
	}

	/**
	 * @param array $mValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_methodsAssigned(array $mValue)
	{
		$oDTValue = DTValue::create()->set_mValue($mValue); 
		\MVC\Event::run('DTRoute.set_methodsAssigned.before', $oDTValue);
		$this->methodsAssigned = (array) $oDTValue->get_mValue();

		return $this;
	}

	/**
	 * @param string $mValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_query(string $mValue)
	{
		$oDTValue = DTValue::create()->set_mValue($mValue); 
		\MVC\Event::run('DTRoute.set_query.before', $oDTValue);
		$this->query = (string) $oDTValue->get_mValue();

		return $this;
	}

	/**
	 * @param string $mValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_class(string $mValue)
	{
		$oDTValue = DTValue::create()->set_mValue($mValue); 
		\MVC\Event::run('DTRoute.set_class.before', $oDTValue);
		$this->class = (string) $oDTValue->get_mValue();

		return $this;
	}

	/**
	 * @param string $mValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_classFile(string $mValue)
	{
		$oDTValue = DTValue::create()->set_mValue($mValue); 
		\MVC\Event::run('DTRoute.set_classFile.before', $oDTValue);
		$this->classFile = (string) $oDTValue->get_mValue();

		return $this;
	}

	/**
	 * @param string $mValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_module(string $mValue)
	{
		$oDTValue = DTValue::create()->set_mValue($mValue); 
		\MVC\Event::run('DTRoute.set_module.before', $oDTValue);
		$this->module = (string) $oDTValue->get_mValue();

		return $this;
	}

	/**
	 * @param string $mValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_c(string $mValue)
	{
		$oDTValue = DTValue::create()->set_mValue($mValue); 
		\MVC\Event::run('DTRoute.set_c.before', $oDTValue);
		$this->c = (string) $oDTValue->get_mValue();

		return $this;
	}

	/**
	 * @param string $mValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_m(string $mValue)
	{
		$oDTValue = DTValue::create()->set_mValue($mValue); 
		\MVC\Event::run('DTRoute.set_m.before', $oDTValue);
		$this->m = (string) $oDTValue->get_mValue();

		return $this;
	}

	/**
	 * @param mixed $mValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_additional(mixed $mValue)
	{
		$oDTValue = DTValue::create()->set_mValue($mValue); 
		\MVC\Event::run('DTRoute.set_additional.before', $oDTValue);
		$this->additional = $oDTValue->get_mValue();

		return $this;
	}

	/**
	 * @param string $mValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_tag(string $mValue)
	{
		$oDTValue = DTValue::create()->set_mValue($mValue); 
		\MVC\Event::run('DTRoute.set_tag.before', $oDTValue);
		$this->tag = (string) $oDTValue->get_mValue();

		return $this;
	}

	/**
	 * @return string
	 * @throws \ReflectionException
	 */
	public function get_path() : string
	{
		$oDTValue = DTValue::create()->set_mValue($this->path); 
		\MVC\Event::run('DTRoute.get_path.before', $oDTValue);

		return $oDTValue->get_mValue();
	}

	/**
	 * @return string
	 * @throws \ReflectionException
	 */
	public function get_method() : string
	{
		$oDTValue = DTValue::create()->set_mValue($this->method); 
		\MVC\Event::run('DTRoute.get_method.before', $oDTValue);

		return $oDTValue->get_mValue();
	}

	/**
	 * @return array
	 * @throws \ReflectionException
	 */
	public function get_methodsAssigned() : array
	{
		$oDTValue = DTValue::create()->set_mValue($this->methodsAssigned); 
		\MVC\Event::run('DTRoute.get_methodsAssigned.before', $oDTValue);

		return $oDTValue->get_mValue();
	}

	/**
	 * @return string
	 * @throws \ReflectionException
	 */
	public function get_query() : string
	{
		$oDTValue = DTValue::create()->set_mValue($this->query); 
		\MVC\Event::run('DTRoute.get_query.before', $oDTValue);

		return $oDTValue->get_mValue();
	}

	/**
	 * @return string
	 * @throws \ReflectionException
	 */
	public function get_class() : string
	{
		$oDTValue = DTValue::create()->set_mValue($this->class); 
		\MVC\Event::run('DTRoute.get_class.before', $oDTValue);

		return $oDTValue->get_mValue();
	}

	/**
	 * @return string
	 * @throws \ReflectionException
	 */
	public function get_classFile() : string
	{
		$oDTValue = DTValue::create()->set_mValue($this->classFile); 
		\MVC\Event::run('DTRoute.get_classFile.before', $oDTValue);

		return $oDTValue->get_mValue();
	}

	/**
	 * @return string
	 * @throws \ReflectionException
	 */
	public function get_module() : string
	{
		$oDTValue = DTValue::create()->set_mValue($this->module); 
		\MVC\Event::run('DTRoute.get_module.before', $oDTValue);

		return $oDTValue->get_mValue();
	}

	/**
	 * @return string
	 * @throws \ReflectionException
	 */
	public function get_c() : string
	{
		$oDTValue = DTValue::create()->set_mValue($this->c); 
		\MVC\Event::run('DTRoute.get_c.before', $oDTValue);

		return $oDTValue->get_mValue();
	}

	/**
	 * @return string
	 * @throws \ReflectionException
	 */
	public function get_m() : string
	{
		$oDTValue = DTValue::create()->set_mValue($this->m); 
		\MVC\Event::run('DTRoute.get_m.before', $oDTValue);

		return $oDTValue->get_mValue();
	}

	/**
	 * @return mixed|null
	 * @throws \ReflectionException
	 */
	public function get_additional()
	{
		$oDTValue = DTValue::create()->set_mValue($this->additional); 
		\MVC\Event::run('DTRoute.get_additional.before', $oDTValue);

		return $oDTValue->get_mValue();
	}

	/**
	 * @return string
	 * @throws \ReflectionException
	 */
	public function get_tag() : string
	{
		$oDTValue = DTValue::create()->set_mValue($this->tag); 
		\MVC\Event::run('DTRoute.get_tag.before', $oDTValue);

		return $oDTValue->get_mValue();
	}

	/**
	 * @return string
	 */
	public static function getPropertyName_path()
	{
        return 'path';
	}

	/**
	 * @return string
	 */
	public static function getPropertyName_method()
	{
        return 'method';
	}

	/**
	 * @return string
	 */
	public static function getPropertyName_methodsAssigned()
	{
        return 'methodsAssigned';
	}

	/**
	 * @return string
	 */
	public static function getPropertyName_query()
	{
        return 'query';
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
	public static function getPropertyName_classFile()
	{
        return 'classFile';
	}

	/**
	 * @return string
	 */
	public static function getPropertyName_module()
	{
        return 'module';
	}

	/**
	 * @return string
	 */
	public static function getPropertyName_c()
	{
        return 'c';
	}

	/**
	 * @return string
	 */
	public static function getPropertyName_m()
	{
        return 'm';
	}

	/**
	 * @return string
	 */
	public static function getPropertyName_additional()
	{
        return 'additional';
	}

	/**
	 * @return string
	 */
	public static function getPropertyName_tag()
	{
        return 'tag';
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
