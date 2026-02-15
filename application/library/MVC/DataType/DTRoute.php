<?php

/**
 * @name $MVCDataType
 */
namespace MVC\DataType;

use MVC\DataType\DTValue;
use MVC\MVCTrait\TraitDataType;

class DTRoute
{
	use TraitDataType;

	public const DTHASH = '0160d5c53d1e46257735619a2bc59d38';

	/**
	 * @required true
	 * @var string
	 */
	protected $path;

	/**
	 * @required true
	 * @var string
	 */
	protected $requestMethod;

	/**
	 * @required true
	 * @var array
	 */
	protected $methodsAssigned;

	/**
	 * @required true
	 * @var string
	 */
	protected $classMethod;

	/**
	 * @required true
	 * @var string
	 */
	protected $module;

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
	protected $method;

	/**
	 * @required false
	 * @var \MVC\DataType\DTRoutingAdditional|null
	 */
	protected $additional;

	/**
	 * @required false
	 * @var string
	 */
	protected $tag;

	/**
	 * DTRoute constructor.
	 * @param DTValue $oDTValue
	 * @throws \ReflectionException 
	 */
	protected function __construct(DTValue $oDTValue)
	{
		\MVC\Event::run('DTRoute.__construct.before', $oDTValue);
		$aData = $oDTValue->get_mValue();
		$this->path = '';
		$this->requestMethod = '';
		$this->methodsAssigned = [];
		$this->classMethod = '';
		$this->module = '';
		$this->class = '';
		$this->classFile = '';
		$this->method = '';
		$this->additional = null;
		$this->tag = '';
		$this->setProperties($oDTValue);

		$oDTValue = DTValue::create()->set_mValue($aData); 
		\MVC\Event::run('DTRoute.__construct.after', $oDTValue);
	}

    /**
     * @param array|null $aData
     * @return DTRoute
     * @throws \ReflectionException
     */
    public static function create(?array $aData = array())
    {            
        (null === $aData) ? $aData = array() : false;
        $oDTValue = DTValue::create()->set_mValue($aData);
		\MVC\Event::run('DTRoute.create.before', $oDTValue);
		$oObject = new self($oDTValue);
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
		$this->path =  (string) $oDTValue->get_mValue() ;

		return $this;
	}

	/**
	 * @param string $mValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_requestMethod(string $mValue)
	{
		$oDTValue = DTValue::create()->set_mValue($mValue); 
		\MVC\Event::run('DTRoute.set_requestMethod.before', $oDTValue);
		$this->requestMethod =  (string) $oDTValue->get_mValue() ;

		return $this;
	}

	/**
	 * @param array  $mValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_methodsAssigned(array $mValue)
	{
		$oDTValue = DTValue::create()->set_mValue($mValue); 
		\MVC\Event::run('DTRoute.set_methodsAssigned.before', $oDTValue);

		$this->methodsAssigned =  $mValue ;

		return $this;
	}

	/**
	 * @param array $mValue
	 * @return $this
	 * @throws \ReflectionException 
	 */
	public function add_methodsAssigned(array $mValue)
	{
		$oDTValue = DTValue::create()->set_mValue($this->methodsAssigned); 
		\MVC\Event::run('DTRoute.add_methodsAssigned.before', $oDTValue);

		$this->methodsAssigned[] = $mValue;

		return $this;
	}

	/**
	 * @param string $mValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_classMethod(string $mValue)
	{
		$oDTValue = DTValue::create()->set_mValue($mValue); 
		\MVC\Event::run('DTRoute.set_classMethod.before', $oDTValue);
		$this->classMethod =  (string) $oDTValue->get_mValue() ;

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
		$this->module =  (string) $oDTValue->get_mValue() ;

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
		$this->class =  (string) $oDTValue->get_mValue() ;

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
		$this->classFile =  (string) $oDTValue->get_mValue() ;

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
		$this->method =  (string) $oDTValue->get_mValue() ;

		return $this;
	}

	/**
	 * @param \MVC\DataType\DTRoutingAdditional|null $mValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_additional(?\MVC\DataType\DTRoutingAdditional $mValue)
	{
		$oDTValue = DTValue::create()->set_mValue($mValue); 
		\MVC\Event::run('DTRoute.set_additional.before', $oDTValue);
		$this->additional =  $oDTValue->get_mValue() ;

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
		$this->tag =  (string) $oDTValue->get_mValue() ;

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
	public function get_requestMethod() : string
	{
		$oDTValue = DTValue::create()->set_mValue($this->requestMethod); 
		\MVC\Event::run('DTRoute.get_requestMethod.before', $oDTValue);

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
	public function get_classMethod() : string
	{
		$oDTValue = DTValue::create()->set_mValue($this->classMethod); 
		\MVC\Event::run('DTRoute.get_classMethod.before', $oDTValue);

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
	public function get_method() : string
	{
		$oDTValue = DTValue::create()->set_mValue($this->method); 
		\MVC\Event::run('DTRoute.get_method.before', $oDTValue);

		return $oDTValue->get_mValue();
	}

	/**
	 * @return \MVC\DataType\DTRoutingAdditional|null
	 * @throws \ReflectionException
	 */
	public function get_additional() : ?\MVC\DataType\DTRoutingAdditional
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
	public static function getPropertyName_requestMethod()
	{
        return 'requestMethod';
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
	public static function getPropertyName_classMethod()
	{
        return 'classMethod';
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
	public static function getPropertyName_method()
	{
        return 'method';
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
