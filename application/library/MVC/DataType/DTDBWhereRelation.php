<?php
# 2024-01-13 13:11:02

/**
 * @name $MVCDataType
 */
namespace MVC\DataType;

use MVC\DataType\DTValue;
use MVC\MVCTrait\TraitDataType;

class DTDBWhereRelation
{
	use TraitDataType;

	public const DTHASH = '63de1d4ec9c8badee5b531fa2eeefd2b';

	public const smallerThan = "<";

	public const smallerThanOrEqualTo = "<=";

	public const equal = "=";

	public const greaterThan = ">";

	public const greaterThanOrEqualTo = ">=";

	public const In = "IN";

	/**
	 * DTDBWhereRelation constructor.
	 * @param array $aData
	 * @throws \ReflectionException 
	 */
	public function __construct(array $aData = array())
	{
		$oDTValue = DTValue::create()->set_mValue($aData);
		\MVC\Event::run('DTDBWhereRelation.__construct.before', $oDTValue);
		$aData = $oDTValue->get_mValue();


		foreach ($aData as $sKey => $mValue)
		{
			$sMethod = 'set_' . $sKey;

			if (method_exists($this, $sMethod))
			{
				$this->$sMethod($mValue);
			}
		}

		$oDTValue = DTValue::create()->set_mValue($aData); \MVC\Event::run('DTDBWhereRelation.__construct.after', $oDTValue);
	}

    /**
     * @param array $aData
     * @return DTDBWhereRelation
     * @throws \ReflectionException
     */
    public static function create(array $aData = array())
    {
        $oDTValue = DTValue::create()->set_mValue($aData);
		\MVC\Event::run('DTDBWhereRelation.create.before', $oDTValue);
		$oObject = new self($oDTValue->get_mValue());
        $oDTValue = DTValue::create()->set_mValue($oObject); \MVC\Event::run('DTDBWhereRelation.create.after', $oDTValue);

        return $oDTValue->get_mValue();
    }

}
