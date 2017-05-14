<?php

namespace Model;

class ShipCollection implements \ArrayAccess, \IteratorAggregate
{
	/**
	 * 
	 * @var array AbstractShip[]
	 */
	private $ships;
	
	/**
	 * 
	 * @param array $ships
	 */
	public function __construct(array $ships)
	{
		$this->ships = $ships;
	}
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see ArrayAccess::offsetExists()
	 */
	public function offsetExists($offset)
	{
		return array_key_exists($offset, $this->ships);
	}
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see ArrayAccess::offsetGet()
	 */
	public function offsetGet($offset)
	{
		return $this->ships[$offset];
	}
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see ArrayAccess::offsetSet()
	 */
	public function offsetSet($offset, $value)
	{
		$this->ships[$offset] = $value;
	}
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see ArrayAccess::offsetUnset()
	 */
	public function offsetUnset($offset)
	{
		unset($this->ships[$offset]);
	}
	
	/**
	 * 
	 * @return \ArrayIterator
	 */
	public function getIterator()
	{
		return new \ArrayIterator($this->ships);
	}
	
	public function removeAllBrokenShips()
	{
		foreach ($this->ships as $key => $ship) {
			if (!$ship->isFunctional()) {
				unset($this->ships[$key]);
			}
		}
	}
}