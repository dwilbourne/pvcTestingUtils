<?php

declare (strict_types=1);
/**
 * @author: Doug Wilbourne (dougwilbourne@gmail.com)
 */

namespace pvc\testingTraits\phpunit;

use PHPUnit\Framework\MockObject\MockObject;
use stdClass;

trait PhpunitCountableTrait
{
	public function mockCountable(MockObject $mock, array $items) : MockObject
	{
		$iteratorData = new stdClass();
		$iteratorData->array = $items;

		$mock->method('count')->with()->will($this->returnCallback(
			function () use ($iteratorData) {
				return sizeof($iteratorData->array);
			}
		));

		return $mock;
	}

}