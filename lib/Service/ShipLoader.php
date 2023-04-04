<?php

namespace Service;

use Model\BountyHunterShip;
use Model\RebelShip;
use Model\Ship;
use Model\AbstractShip;
use Model\ShipCollection;

class ShipLoader
{
    private $shipStorage;

    public function __construct(ShipStorageInterface $shipStorage)
    {
        $this->shipStorage = $shipStorage;
    }

    /**
     * @return ShipCollection
     */
    public function getShips()
    {
        //using try and catch so that if we get an exception, the page won't 'die' and show the error to the user. it will just come up with 0 ships
        try {
            $shipsData = $this->queryForShips();
        }catch (\PDOException $e){
            trigger_error('Database Exception! ' . $e->getMessage());
            $shipsData = [];
        }
        $ships = array();
        foreach ($shipsData as $shipData) {
            $ships[] = $this->createShipFromData($shipData);
        }

        $ships[] = new BountyHunterShip('Slave I');

        return new ShipCollection($ships);
    }

    /**
     * @param $id
     * @return AbstractShip
     */
    public function findOneById($id)
    {
        $shipArray = $this->shipStorage->fetchSingleShipData($id);

        return $this->createShipFromData($shipArray);
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

    private function queryForShips()
    {
        return $this->shipStorage->fetchAllShipsData();
    }
}

