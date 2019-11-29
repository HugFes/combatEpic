<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TrollRepository")
 */
class Troll extends Warrior
{

    public function __construct(){
        // parent::__construct();
        
        //création du cobattant
        $this->setStrength(self::BASE_FORCE);
        $this->setIntelligence(self::BASE_INTELLIGENCE);
        $this->setPv(ceil(self::BASE_PV * (rand(23, 30)/10)));
    }

    public function getRace()
    {
        return "Troll";
    }
}
