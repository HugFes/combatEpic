<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\NainRepository")
 */
class Nain extends Warrior
{

    public function __construct(){
        // parent::__construct();
        
        //création du cobattant
        $this->setStrength(ceil(self::BASE_FORCE * (rand(15, 20)/10)));
        $this->setIntelligence(self::BASE_INTELLIGENCE);
        $this->setPv(self::BASE_PV );
    }

    public function getRace()
    {
        return 'Nain';
    }

}
