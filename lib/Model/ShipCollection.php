<?php

namespace Model;

use Traversable;
//only purpose of this class is to be a wrapper around an array
//IteratorAggregate interface lets us loop over an object like an array
class ShipCollection implements \ArrayAccess, \IteratorAggregate
{
    /**
     * @var AbstractShip
     */
    private $ships;

    public function __construct(array $ships){
        $this->ships = $ships;
    }

    public function offsetGet($offset)
    {
        return $this->ships[$offset];
    }
    public function offsetSet($offset, $value)
    {
        $this->ships[$offset] = $value;
    }
    public function offsetExists($offset)
    {
       return array_key_exists($offset, $this->ships);
    }
    public function offsetUnset($offset)
    {
        unset($this->ships[$offset]);
    }

    public function getIterator()
    {
        return new \ArrayIterator($this->ships);
    }

    public function removeAllBrokenShips(){
        foreach($this->ships as $key => $ship){
            if(!$ship->isFunctional()){
                unset($this->ships[$key]);
            }
        }
    }
}