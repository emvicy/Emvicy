<?php
# 2024-01-11 14:11:23

/**
 * @name $MVCDataType
 */
namespace MVC\DataType;

use MVC\MVCTrait\TraitDataType;

class DTDBWhereRelation
{
	use TraitDataType;

	public const smallerThan = "<";

	public const smallerThanOrEqualTo = "<=";

	public const equal = "=";

	public const greaterThan = ">";

	public const greaterThanOrEqualTo = ">=";

	public const In = "IN";
}
