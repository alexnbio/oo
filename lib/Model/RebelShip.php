<?php

namespace Model;

/**
 * @author alex
 *
 */
class RebelShip extends AbstractShip
{
	/**
	 * 
	 * {@inheritDoc}
	 * @see Ship::getJediFactor()
	 */
	public function getJediFactor()
	{
		return rand(10, 30);
	}
	
	public function getFavoriteJedi()
	{
		$coolJedis = array('Yoda', 'Ben Kenobi');
		$key = array_rand($coolJedis);
		return $coolJedis[$key];
	}
	
	/**
	 *
	 * @return string
	 */
	public function getType()
	{
		return 'Rebel';
	}
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see Ship::isFunctional()
	 */
	public function isFunctional()
	{
		return true;
	}
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see Ship::getNameAndSpecs()
	 */
	public function getNameAndSpecs($userShortFormat = false)
	{
		$val  = parent::getNameAndSpecs($userShortFormat);
		$val .= ' (Rebel)';
		
		return $val;
	}
}