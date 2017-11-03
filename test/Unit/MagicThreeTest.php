<?php declare(strict_types=1);

namespace Kata\test\Unit;

use Kata\src\MagicThree;
use PHPUnit\Framework\TestCase;

/**
 * @package Kata\test\Unit
 */
class MagicThreeTest extends TestCase
{
	public function testMagicThree()
	{
		$magicThree = new MagicThree();
		$test       = $magicThree->magicThree([0, -5, 5, 5, -5]);

		var_dump($test);
	}
}
