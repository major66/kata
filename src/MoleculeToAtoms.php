<?php

namespace Kata\src;

use function in_array;
use function str_replace;
use function strlen;

/**
 * @package Kata\src
 */
class MoleculeToAtoms
{
	/**
	 * 'As2{Be4C5[BCo3(CO2)3]2}4Cu5', ['As' => 2, 'Cu' => 5, 'Be' => 16, 'C' => 44, 'B' => 8, 'Co' => 24, 'O' => 48
	 *
	 * As2
	 * {
	 * Be4
	 * C5
	 * [BCo3(CO2)3]2
	 * }4
	 * Cu5
	 */

	/**
	 * @param string $string
	 *
	 * @return array
	 */
	public function parse_molecule(string $string): array {
		$elementsFinded = [];
		$separatedItemsFinded = $this->seperateItems($string);

		$this->calculateBraces($separatedItemsFinded['braces'][0]);

		return true;
	}

	/**
	 * @param $string
	 *
	 * @return array
	 */
	private function seperateItems($string) {
		$items = [];

		while (strlen($string))
		{
			$itemWithBracesToAdd = $this->findItemInString($string, ['{', '}']);

			if ($itemWithBracesToAdd != false)
			{
				$items['braces'][] = $itemWithBracesToAdd['element'];
				$string  = $itemWithBracesToAdd['string'];
				unset($itemWithBracesToAdd);
			}

			$itemWithBracketToAdd = $this->findItemInString($items['braces'][0], ['[', ']']);

			if ($itemWithBracketToAdd != false)
			{
				$items['brackets'][] = $itemWithBracketToAdd['element'];
				//$string  = $itemWithBracketToAdd['string'];
				unset($itemWithBracketToAdd);
			}
			$items['simpleElements'] = $this->getSimpleElement($string);
			$string = '';
		}

		return $items;
	}

	/**
	 * @param string $string
	 * @param array  $elementsToFind
	 *
	 * @return array|bool
	 */
	private function findItemInString(string $string, array $elementsToFind)
	{
		$positionFirstOccurence = strpos($string, $elementsToFind[0]);

		if ($positionFirstOccurence !== false)
		{
			$positionLastOccurence = strpos($string, $elementsToFind[1]);
			$element = substr($string, $positionFirstOccurence, $positionLastOccurence - $positionFirstOccurence + 2);
			$string  = str_replace($element, '', $string);

			return ['string' => $string, 'element' => $element];
		}

		return false;
	}

	/**
	 * @param $string
	 *
	 * @return array
	 */
	private function getSimpleElement(string $string)
	{
		$items   = [];
		$element = '';
		$length  = strlen($string);

		for ($iterator = 0; $iterator < $length; $iterator++) {
			if (is_numeric($string[$iterator]) )
			{
				$items[]['element'] = $element;
				$items[]['value']   = $string[$iterator];
				$element = '';

				continue;
			}

			$element .= $string[$iterator];
		}

		return $items;
	}

	private function calculateBraces(string $bracesFinded)
	{
		/**
		 * {Be4C5[BCo3(CO2)3]2}4
		 */

		//check brackets
		//check Parenthesis

		$multiplyBy   = $bracesFinded[strlen($bracesFinded)-1];
		$bracesFinded = substr($bracesFinded, 0, -1);
		$bracesFinded = str_replace('{', '', $bracesFinded);
		$bracesFinded = str_replace('}', '', $bracesFinded);

		if(strpos($bracesFinded, '['))
		{

		}
	}
}

