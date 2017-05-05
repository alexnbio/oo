<?php

require __DIR__.'/lib/Ship.php';

$myShip              = new Ship();
$myShip->name        = "TIE Figher";
$myShip->weaponPower = 10;

/**
 * Get a Ship object and prints some summary about it
 * 
 * @param Ship $someShip
 */
function printShipSummary(Ship $someShip)
{
	echo 'Ship Name: '.$someShip->getName();
	echo '<hr/>';
	$someShip->sayHello();
	echo '<hr/>';
	echo $someShip->getNameAndSpecs(false);
	echo '<hr/>';
	echo $someShip->getNameAndSpecs(true);
}

printShipSummary($myShip);

$otherShip              = new Ship();
$otherShip->name        = 'Imperial Shuttle';
$otherShip->weaponPower = 5;
$otherShip->strength    = 50;

echo '<hr/>';
echo '<hr/>';
printShipSummary($otherShip);

echo '<hr/>';
echo '<hr/>';
echo '<hr/>';

if ($myShip->doesGivenShipHaveMoreStrength($otherShip)) {
	echo $otherShip->name.' has more strength';
} else {
	echo $myShip->name.' has more strength';
}
