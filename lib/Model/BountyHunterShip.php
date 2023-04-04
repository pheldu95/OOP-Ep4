<?php

namespace Model;

class BountyHunterShip extends AbstractShip
{
    //basically copies the contents of the trait we made and pastes it here
    use SettableJediFactorTrait;

    public function getType()
    {
        return 'Bounty Hunter';
    }

    public function isFunctional()
    {
        return true;
    }
}