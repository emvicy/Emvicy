<?php

/**
 * @name $MVCDataType
 */
namespace MVC\DataType;

use MVC\DataType\DTValue;
use MVC\MVCTrait\TraitDataType;

class DTResponse
{
	use TraitDataType;

	public const DTHASH = '1e1099fecdcceee403024d613ac971f4';

	/**
	 * @required true
	 * @var string
	 */
	protected $body;

	/**
	 * @required true
	 * @var string
	 */
	protected $raw;

	/**
	 * @required true
	 * @var array
	 */
	protected $headers;

	/**
	 * @required true
	 * @var int
	 */
	protected $status_code;

	/**
	 * @required true
	 * @var int
	 */
	protected $processingTime;

	/**
	 * @required true
	 * @var float
	 */
	protected $protocol_version;

	/**
	 * @required true
	 * @var bool
	 */
	protected $success;

	/**
	 * @required false
	 * @var int
	 */
	protected $redirects;

	/**
	 * @required true
	 * @var string
	 */
	protected $url;

	/**
	 * @required false
	 * @var array
	 */
	protected $history;

	/**
	 * @required false
	 * @var array
	 */
	protected $cookies;

	/**
	 * DTResponse constructor.
	 * @param DTValue $oDTValue
	 * @throws \ReflectionException 
	 */
	protected function __construct(DTValue $oDTValue)
	{
		\MVC\Event::run('DTResponse.__construct.before', $oDTValue);
		$aData = $oDTValue->get_mValue();
		$this->body = '';
		$this->raw = '';
		$this->headers = [];
		$this->status_code = 0;
		$this->processingTime = 0;
		$this->protocol_version = 0;
		$this->success = false;
		$this->redirects = 0;
		$this->url = '';
		$this->history = [];
		$this->cookies = [];
		$this->setProperties($oDTValue);

		$oDTValue = DTValue::create()->set_mValue($aData); 
		\MVC\Event::run('DTResponse.__construct.after', $oDTValue);
	}

    /**
     * @param array|null $aData
     * @return DTResponse
     * @throws \ReflectionException
     */
    public static function create(?array $aData = array())
    {            
        (null === $aData) ? $aData = array() : false;
        $oDTValue = DTValue::create()->set_mValue($aData);
		\MVC\Event::run('DTResponse.create.before', $oDTValue);
		$oObject = new self($oDTValue);
        $oDTValue = DTValue::create()->set_mValue($oObject); \MVC\Event::run('DTResponse.create.after', $oDTValue);

        return $oDTValue->get_mValue();
    }

	/**
	 * @param string $mValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_body(string $mValue)
	{
		$oDTValue = DTValue::create()->set_mValue($mValue); 
		\MVC\Event::run('DTResponse.set_body.before', $oDTValue);
		$this->body = (string) $oDTValue->get_mValue();

		return $this;
	}

	/**
	 * @param string $mValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_raw(string $mValue)
	{
		$oDTValue = DTValue::create()->set_mValue($mValue); 
		\MVC\Event::run('DTResponse.set_raw.before', $oDTValue);
		$this->raw = (string) $oDTValue->get_mValue();

		return $this;
	}

	/**
	 * @param array  $mValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_headers(array $mValue)
	{
		$oDTValue = DTValue::create()->set_mValue($mValue); 
		\MVC\Event::run('DTResponse.set_headers.before', $oDTValue);

		$this->headers = $mValue;

		return $this;
	}

	/**
	 * @param array $mValue
	 * @return $this
	 * @throws \ReflectionException 
	 */
	public function add_headers(array $mValue)
	{
		$oDTValue = DTValue::create()->set_mValue($this->headers); 
		\MVC\Event::run('DTResponse.add_headers.before', $oDTValue);

		$this->headers[] = $mValue;

		return $this;
	}

	/**
	 * @param int $mValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_status_code(int $mValue)
	{
		$oDTValue = DTValue::create()->set_mValue($mValue); 
		\MVC\Event::run('DTResponse.set_status_code.before', $oDTValue);
		$this->status_code = (int) $oDTValue->get_mValue();

		return $this;
	}

	/**
	 * @param int $mValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_processingTime(int $mValue)
	{
		$oDTValue = DTValue::create()->set_mValue($mValue); 
		\MVC\Event::run('DTResponse.set_processingTime.before', $oDTValue);
		$this->processingTime = (int) $oDTValue->get_mValue();

		return $this;
	}

	/**
	 * @param float $mValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_protocol_version(float $mValue)
	{
		$oDTValue = DTValue::create()->set_mValue($mValue); 
		\MVC\Event::run('DTResponse.set_protocol_version.before', $oDTValue);
		$this->protocol_version = (float) $oDTValue->get_mValue();

		return $this;
	}

	/**
	 * @param bool $mValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_success(bool $mValue)
	{
		$oDTValue = DTValue::create()->set_mValue($mValue); 
		\MVC\Event::run('DTResponse.set_success.before', $oDTValue);
		$this->success = (bool) $oDTValue->get_mValue();

		return $this;
	}

	/**
	 * @param int $mValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_redirects(int $mValue)
	{
		$oDTValue = DTValue::create()->set_mValue($mValue); 
		\MVC\Event::run('DTResponse.set_redirects.before', $oDTValue);
		$this->redirects = (int) $oDTValue->get_mValue();

		return $this;
	}

	/**
	 * @param string $mValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_url(string $mValue)
	{
		$oDTValue = DTValue::create()->set_mValue($mValue); 
		\MVC\Event::run('DTResponse.set_url.before', $oDTValue);
		$this->url = (string) $oDTValue->get_mValue();

		return $this;
	}

	/**
	 * @param array  $mValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_history(array $mValue)
	{
		$oDTValue = DTValue::create()->set_mValue($mValue); 
		\MVC\Event::run('DTResponse.set_history.before', $oDTValue);

		$this->history = $mValue;

		return $this;
	}

	/**
	 * @param array $mValue
	 * @return $this
	 * @throws \ReflectionException 
	 */
	public function add_history(array $mValue)
	{
		$oDTValue = DTValue::create()->set_mValue($this->history); 
		\MVC\Event::run('DTResponse.add_history.before', $oDTValue);

		$this->history[] = $mValue;

		return $this;
	}

	/**
	 * @param array  $mValue 
	 * @return $this
	 * @throws \ReflectionException
	 */
	public function set_cookies(array $mValue)
	{
		$oDTValue = DTValue::create()->set_mValue($mValue); 
		\MVC\Event::run('DTResponse.set_cookies.before', $oDTValue);

		$this->cookies = $mValue;

		return $this;
	}

	/**
	 * @param array $mValue
	 * @return $this
	 * @throws \ReflectionException 
	 */
	public function add_cookies(array $mValue)
	{
		$oDTValue = DTValue::create()->set_mValue($this->cookies); 
		\MVC\Event::run('DTResponse.add_cookies.before', $oDTValue);

		$this->cookies[] = $mValue;

		return $this;
	}

	/**
	 * @return string
	 * @throws \ReflectionException
	 */
	public function get_body() : string
	{
		$oDTValue = DTValue::create()->set_mValue($this->body); 
		\MVC\Event::run('DTResponse.get_body.before', $oDTValue);

		return $oDTValue->get_mValue();
	}

	/**
	 * @return string
	 * @throws \ReflectionException
	 */
	public function get_raw() : string
	{
		$oDTValue = DTValue::create()->set_mValue($this->raw); 
		\MVC\Event::run('DTResponse.get_raw.before', $oDTValue);

		return $oDTValue->get_mValue();
	}

	/**
	 * @return array
	 * @throws \ReflectionException
	 */
	public function get_headers() : array
	{
		$oDTValue = DTValue::create()->set_mValue($this->headers); 
		\MVC\Event::run('DTResponse.get_headers.before', $oDTValue);

		return $oDTValue->get_mValue();
	}

	/**
	 * @return int
	 * @throws \ReflectionException
	 */
	public function get_status_code() : int
	{
		$oDTValue = DTValue::create()->set_mValue($this->status_code); 
		\MVC\Event::run('DTResponse.get_status_code.before', $oDTValue);

		return $oDTValue->get_mValue();
	}

	/**
	 * @return int
	 * @throws \ReflectionException
	 */
	public function get_processingTime() : int
	{
		$oDTValue = DTValue::create()->set_mValue($this->processingTime); 
		\MVC\Event::run('DTResponse.get_processingTime.before', $oDTValue);

		return $oDTValue->get_mValue();
	}

	/**
	 * @return float
	 * @throws \ReflectionException
	 */
	public function get_protocol_version() : float
	{
		$oDTValue = DTValue::create()->set_mValue($this->protocol_version); 
		\MVC\Event::run('DTResponse.get_protocol_version.before', $oDTValue);

		return $oDTValue->get_mValue();
	}

	/**
	 * @return bool
	 * @throws \ReflectionException
	 */
	public function get_success() : bool
	{
		$oDTValue = DTValue::create()->set_mValue($this->success); 
		\MVC\Event::run('DTResponse.get_success.before', $oDTValue);

		return $oDTValue->get_mValue();
	}

	/**
	 * @return int
	 * @throws \ReflectionException
	 */
	public function get_redirects() : int
	{
		$oDTValue = DTValue::create()->set_mValue($this->redirects); 
		\MVC\Event::run('DTResponse.get_redirects.before', $oDTValue);

		return $oDTValue->get_mValue();
	}

	/**
	 * @return string
	 * @throws \ReflectionException
	 */
	public function get_url() : string
	{
		$oDTValue = DTValue::create()->set_mValue($this->url); 
		\MVC\Event::run('DTResponse.get_url.before', $oDTValue);

		return $oDTValue->get_mValue();
	}

	/**
	 * @return array
	 * @throws \ReflectionException
	 */
	public function get_history() : array
	{
		$oDTValue = DTValue::create()->set_mValue($this->history); 
		\MVC\Event::run('DTResponse.get_history.before', $oDTValue);

		return $oDTValue->get_mValue();
	}

	/**
	 * @return array
	 * @throws \ReflectionException
	 */
	public function get_cookies() : array
	{
		$oDTValue = DTValue::create()->set_mValue($this->cookies); 
		\MVC\Event::run('DTResponse.get_cookies.before', $oDTValue);

		return $oDTValue->get_mValue();
	}

	/**
	 * @return string
	 */
	public static function getPropertyName_body()
	{
        return 'body';
	}

	/**
	 * @return string
	 */
	public static function getPropertyName_raw()
	{
        return 'raw';
	}

	/**
	 * @return string
	 */
	public static function getPropertyName_headers()
	{
        return 'headers';
	}

	/**
	 * @return string
	 */
	public static function getPropertyName_status_code()
	{
        return 'status_code';
	}

	/**
	 * @return string
	 */
	public static function getPropertyName_processingTime()
	{
        return 'processingTime';
	}

	/**
	 * @return string
	 */
	public static function getPropertyName_protocol_version()
	{
        return 'protocol_version';
	}

	/**
	 * @return string
	 */
	public static function getPropertyName_success()
	{
        return 'success';
	}

	/**
	 * @return string
	 */
	public static function getPropertyName_redirects()
	{
        return 'redirects';
	}

	/**
	 * @return string
	 */
	public static function getPropertyName_url()
	{
        return 'url';
	}

	/**
	 * @return string
	 */
	public static function getPropertyName_history()
	{
        return 'history';
	}

	/**
	 * @return string
	 */
	public static function getPropertyName_cookies()
	{
        return 'cookies';
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
