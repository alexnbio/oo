<?php

namespace Model;

class BattleResult implements \ArrayAccess
{
	private $usedJediPowers;
	private $winningShip;
	private $losingShip;
	
	public function __construct($usedJediPowers, AbstractShip $winningShip = null, AbstractShip $losingShip = null)
	{
		$this->usedJediPowers = $usedJediPowers;
		$this->winningShip = $winningShip;
		$this->losingShip = $losingShip;
	}
	
	/**
	 *
	 * @return the boolean
	 */
	public function wereJediPowersUsed() {
		return $this->usedJediPowers;
	}
	
	/**
	 *
	 * @return the Ship|null
	 */
	public function getWinningShip() {
		return $this->winningShip;
	}
	
	/**
	 *
	 * @return the Ship|null
	 */
	public function getLosingShip() {
		return $this->losingShip;
	}
	
	/**
	 * Was there a winner? Or did everybody die :(
	 *
	 * @return bool
	 */
	public function isThereAWinner()
	{
		return $this->getWinningShip() !== null;
	}
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see ArrayAccess::offsetExists()
	 */
	public function offsetExists($offset)
	{
		return property_exists($this, $offset);
	}
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see ArrayAccess::offsetGet()
	 */
	public function offsetGet($offset)
	{
		return $this->$offset;
	}
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see ArrayAccess::offsetSet()
	 */
	public function offsetSet($offset, $value)
	{
		$this->$offset = $value;
	}
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see ArrayAccess::offsetUnset()
	 */
	public function offsetUnset($offset)
	{
		unset($this->$offset);
	}
	
}