<?php

class ShipLoader 
{
	private $shipStorage;
	
	public function __construct(ShipStorageInterface $shipStorage)
	{
		$this->shipStorage = $shipStorage;
	}
	
	/**
	 * 
	 * @return PDO
	 */
	private function getShipStorage()
	{				
		return $this->shipStorage;
	}
	
	/**
	 * 
	 * @return AbstractShip[]
	 */
	public function getShips()
	{
		$ships = array();
		
		$shipsData = $this->shipStorage->fetchAllShipsData();
		
		foreach ($shipsData as $shipData) {
			$ships[] = $this->createShipFromData($shipData);
		}
		
		return $ships;
		
	}
	
	private function createShipFromData(array $shipData)
	{
		if ($shipData['team'] == 'rebel') {
			$ship = new RebelShip($shipData['name']);
		} else {
			$ship = new Ship($shipData['name']);
			$ship->setJediFactor($shipData['jedi_factor']);
		}
		
		$ship->setId($shipData['id']);
		$ship->setWeaponPower($shipData['weapon_power']);
		$ship->setStrength($shipData['strength']);
		return $ship;
	}
	
	/**
	 * 
	 * @param $id
	 * @return NULL|AbstractShip
	 */
	public function findOneById($id)
	{
		$shipArray = $this->shipStorage->fetchSingleShipData($id);
		
		if (!$shipArray) {
			return null;
		}
		
		return $this->createShipFromData($shipArray);
	}
}