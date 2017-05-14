<?php

namespace Service;

use Model\RebelShip;
use Model\Ship;
use Model\AbstractShip;
use Model\ShipCollection;
use Model\BountyHunterShip;

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
	 * @return ShipCollection
	 */
	public function getShips()
	{
		$ships = array();
		
		$shipsData = $this->queryForShips();
		
		foreach ($shipsData as $shipData) {
			$ships[] = $this->createShipFromData($shipData);
		}
		
		// Boba Fett's ship
		$ships[] = new BountyHunterShip('Slave I');
		
		return new ShipCollection($ships);
		
	}
	
	private function queryForShips()
	{
		try {
			return $this->shipStorage->fetchAllShipsData();
		} catch (\PDOException $e) {
			trigger_error('Database Exception! '.$e->getMessage());
		}
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