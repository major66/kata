<?php

namespace Kata\src;

/**
 * @package Kata\src
 */
class MagicThree
{
	/**
	 * @param array $numbers
	 *
	 * @return array|bool
	 */
	public function magicThree(array $numbers)
	{
		foreach ($numbers as $firstNumber) {
			foreach ($numbers as $secondNumber) {
				foreach ($numbers as $thirdNumber) {
					$combination = [$firstNumber, $secondNumber, $thirdNumber];
					if ($this->isSumEqualZero($combination)) {
						return true;
					}
					unset($combination);
				}
			}
		}

		return false;
	}

	/**
	 * @param array $numbers
	 *
	 * @return bool
	 */
	public function isSumEqualZero(array $numbers)
	{
		$summ = 0;

		foreach ($numbers as $number) {
			$summ += $number;
		}

		return $summ === 0;
	}
}
