<?php

namespace Service;

//wrapper object. this is composition. putting one object inside of another
class LoggableShipStorage implements ShipStorageInterface
{
    private $shipStorage;

    public function __construct(ShipStorageInterface $shipStorage)
    {
        $this->shipStorage = $shipStorage;
    }

    public function fetchAllShipsData()
    {
        $ships = $this->shipStorage->fetchAllShipsData();

        $this->log(sprintf('Just fetch %s ships', count($ships)));

        return $ships;
    }
    public function fetchSingleShipData($id)
    {
        return $this->shipStorage->fetchSingleShipData();
    }

    private function log($message){
        echo $message;
    }
}