<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\Warrior;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ElfeRepository")
 */
class Elfe extends Warrior
{
    public function __construct(){
        // parent::__construct();
        
        //création du cobattant
        $this->setStrength(self::BASE_FORCE);
        $this->setIntelligence(ceil(self::BASE_INTELLIGENCE * (rand(15, 20)/10)));
        $this->setPv(ceil(self::BASE_PV * (rand(15, 25)/10)));
    }

    public function getRace(){
        return "Elfe";
    }

   
}
