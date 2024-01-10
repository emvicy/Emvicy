<?php
# 2024-01-10 16:01:03

/**
 * @name $MVCDataType
 */
namespace MVC\DataType;

use MVC\MVCTrait\TraitDataType;

class DTDBWhereReleation
{
	use TraitDataType;

	public const smallerThan = "<";

	public const smallerThanOrEqualTo = "<=";

	public const equal = "=";

	public const greaterThan = ">";

	public const greaterThanOrEqualTo = ">=";

	public const In = "IN";
}
