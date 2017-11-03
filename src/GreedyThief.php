<?php

namespace Kata\src;

/**
 * @package GreedyThief\src
 */
class GreedyThief
{
	/**
	 * @param $items
	 * @param $weight
	 *
	 * @return array
	 */
	public function greedyThief($items, $weight)
	{
		$possibleCombinations = $this->getPossibleCombinations($items, $weight, 4);
		$priceCombinations    = $this->calculatePriceForAllCombinations($possibleCombinations);
		$bestCombination      = $this->getBestCombination($priceCombinations, $possibleCombinations);

		return $bestCombination;
	}

	/**
	 * @param $items
	 * @param $weight
	 * @param $numberPossibleCombinations
	 *
	 * @return array
	 */
	private function getPossibleCombinations($items, $weight, $numberPossibleCombinations)
	{
		$currentNumberCombination = 0;
		$combinations             = [];

		while ($currentNumberCombination < $numberPossibleCombinations)
		{
			shuffle($items);
			$combinations[] = $this->getCombination($items, $weight);
			$currentNumberCombination ++;
		}

		return $combinations;
	}

	/**
	 * @param array $items
	 * @param       $weight
	 *
	 * @return array
	 */
	private function getCombination(array $items, $weight)
	{
		$bag                 = [];
		$currentBagWeight    = 0;
		for ($iterator = 0; $iterator < count($items); $iterator++)
		{
			$currentBagWeight += $items[$iterator]['weight'];
			if ($currentBagWeight >= $weight)
			{
				return $bag;
			}
			$bag[] = $items[$iterator];
		}
	}

	/**
	 * @param $combinations
	 *
	 * @return array
	 */
	private function calculatePriceForAllCombinations($combinations)
	{
		$priceByCombination = [];

		foreach ($combinations as $combination)
		{
			$price = 0;
			
			for ($iterator = 0; $iterator< count($combination); $iterator++)
			{
				$price += $combination[$iterator]['price'];
			}
			$priceByCombination[] = $price;
		}

		return $priceByCombination;
	}

	/**
	 * @param $priceCombinations
	 * @param $possibleCombinations
	 *
	 * @return mixed
	 */
	public function getBestCombination($priceCombinations, $possibleCombinations)
	{
		$bestCombination = array_keys($priceCombinations, max($priceCombinations));

		return $possibleCombinations[$bestCombination[0]];
	}
}
