<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FightRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Fight
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Warrior")
     * @ORM\JoinColumn(nullable=false)
     */
    private $combattant1;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Warrior")
     * @ORM\JoinColumn(nullable=false)
     */
    private $combattant2;

    /**
     * @ORM\Column(type="array")
     */
    private $rounds = [];

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $zone;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Warrior")
     * @ORM\JoinColumn(nullable=false)
     */
    private $winner;






    public function getId(): ?int
    {
        return $this->id;
    }



    public function getCombattant1(): ?Warrior
    {
        return $this->combattant1;
    }

    public function setCombattant1(?Warrior $combattant1): self
    {
        $this->combattant1 = $combattant1;

        return $this;
    }

    public function getCombattant2(): ?Warrior
    {
        return $this->combattant2;
    }

    public function setCombattant2(?Warrior $combattant2): self
    {
        $this->combattant2 = $combattant2;

        return $this;
    }

    /**
     * @ORM\PostPersist
     */
    public function onPostPersist(){
        $this->getCombattant1()->addFight($this->id);
        $this->getCombattant2()->addFight($this->id);
    }

    public function getRounds(): ?array
    {
        return $this->rounds;
    }

    public function setRounds(array $rounds): self
    {
        $this->rounds = $rounds;

        return $this;
    }

    public function getZone(): ?string
    {
        return $this->zone;
    }

    public function setZone(string $zone): self
    {
        $this->zone = $zone;

        return $this;
    }

    public function getWinner(): ?Warrior
    {
        return $this->winner;
    }

    public function setWinner(?Warrior $winner): self
    {
        $this->winner = $winner;

        return $this;
    }





}
