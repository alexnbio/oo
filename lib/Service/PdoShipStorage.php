<?php

class PdoShipStorage implements ShipStorageInterface
{
	private $pdo;
	
	public function __construct(PDO $pdo)
	{
		$this->pdo = $pdo;
	}
	
	public function getPDO()
	{
		return $this->pdo;
	}
	
	public function fetchAllShipsData()
	{
		$statement = $this->getPDO()->prepare('select * from ship');
		$statement->execute();
		$shipsArray = $statement->fetchAll(PDO::FETCH_ASSOC);
		
		return $shipsArray;
	}
	
	public function fetchSingleShipData($id)
	{
		$statement = $this->getPDO()->prepare('SELECT * FROM ship WHERE id = :id');
		$statement->execute(array('id' => $id));
		$shipArray = $statement->fetch(PDO::FETCH_ASSOC);
		
		if (!$shipArray) {
			return null;
		}
		
		return $shipArray;
	}
	
}