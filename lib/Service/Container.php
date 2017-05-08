<?php


use Battle\BattleManager;

class Container {
	
	private $configuration;
	private $shipLoader;
	private $shipStorage;
	private $battleManager;
	
	public function __construct(array $configuration)
	{
		$this->configuration = $configuration;
	}
	
	/**
	 * @return PDO
	 */
	public function getPDO()
	{
		$pdo = new PDO(
			$this->configuration['db_dsn'],
			$this->configuration['db_user'],
			$this->configuration['db_pass']
		);
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		return $pdo;
	}
	
	/**
	 * 
	 * @return ShipStorageInterface
	 */
	public function getShipStorage()
	{
		if ($this->shipStorage == null) {
// 			$this->shipStorage = new PdoShipStorage($this->getPDO());
			$this->shipStorage = new JsonFileShipStorage(__DIR__.'/../../resources/ships.json');
		}
		return $this->shipStorage;
	}
	
	/**
	 * @return ShipLoader
	 */
	public function getShipLoader() {
		if ($this->shipLoader === null) {
			$this->shipLoader = new ShipLoader($this->getShipStorage());
		}
		return $this->shipLoader;
	}
	
	/**
	 * @return BattleManager
	 */
	public function getBattleManager() {
		if ($this->battleManager === null) {
			$this->battleManager = new BattleManager();
		}
		return $this->battleManager;
	}
}