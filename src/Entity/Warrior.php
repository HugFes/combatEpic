<?php

namespace App\Entity;

use App\Repository\FightRepository;
use Doctrine\ORM\Mapping as ORM;
use Cocur\Slugify\Slugify;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraint as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\WarriorRepository")
 * @ORM\MappedSuperclass
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\HasLifecycleCallbacks()
 * @Vich\Uploadable
 */
class Warrior
{
    const BASE_FORCE = 10;
    const BASE_INTELLIGENCE = 10;
    const BASE_PV = 50;


    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    protected $id;


    /**
     * @var String|null
     * @ORM\Column(type="string", length=255, nullable = true)
     */
    protected $filename;

    /**
     * @var File|null
     *
     * @Vich\UploadableField(mapping = "warrior_image", fileNameProperty="filename")
     */
    protected $imageFile;

    /**
     * @ORM\Column(type="string", length=255)
     *
     */
    protected $nom;

    /**
     * @ORM\Column(type="integer")
     */
    protected $pv;

    /**
     * @ORM\Column(type="integer")
     */
    protected $strength;

    /**
     * @ORM\Column(type="integer")
     */
    protected $intelligence;

    /**
     * @ORM\Column(type="date")
     */
    private $createdDate;

    /**
     * @ORM\Column(type="date")
     */
    private $updatedDate;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $deathDate;

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $fights = [];

    /**
     * @ORM\Column(type="boolean")
     */
    private $winner;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $slug;







    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPv(): ?int
    {
        return $this->pv;
    }

    public function setPv(int $pv): self
    {
        $this->pv = $pv;

        return $this;
    }

    public function getStrength(): ?int
    {
        return $this->strength;
    }

    public function setStrength(int $strength): self
    {
        $this->strength = $strength;

        return $this;
    }

    public function getIntelligence(): ?int
    {
        return $this->intelligence;
    }

    public function setIntelligence(int $intelligence): self
    {
        $this->intelligence = $intelligence;

        return $this;
    }

    public function getCreatedDate(): ?\DateTimeInterface
    {
        return $this->createdDate;
    }

    public function setCreatedDate(\DateTimeInterface $createdDate): self
    {
        $this->createdDate = $createdDate;

        return $this;
    }

    public function getUpdatedDate(): ?\DateTimeInterface
    {
        return $this->updatedDate;
    }

    public function setUpdatedDate(\DateTimeInterface $updatedDate): self
    {
        $this->updatedDate = $updatedDate;

        return $this;
    }

    public function getDeathDate(): ?\DateTimeInterface
    {
        return $this->deathDate;
    }

    public function setDeathDate(?\DateTimeInterface $deathDate): self
    {
        $this->deathDate = $deathDate;

        return $this;
    }

    /**
     * @ORM\PrePersist
     */
    public function onPrePersist(){
        $this->setCreatedDate(new \DateTime());
        $this->setWinner(false);
        $this->setUpdatedDate(new \DateTime());
        $this->setSlug("temporarySlug");
    }

    /**
     * @ORM\PostPersist
     */
    public function onPostPersist(){
        //make slug after persist to get ID
        $slugify = new Slugify();
        $slug = $slugify->slugify($this->getNom())."-".$this->getId();
        $this->setSlug($slug);

        if($this->filename === null || trim($this->filename) == ""){
            switch ($this->getRace()){
                case "Elfe" :
                    $this->setFilename("defaultElfe.jpg");
                    break;

                case "Troll":
                    $this->setFilename("defaultTroll.jpg");
                    break;

                case "Nain":
                    $this->setFilename("defaultNain.jpg");
                    break;

                default :
                    throw new Exception();
            }
        }
    }

    /**
     * @ORM\PreUpdate
     */
    public function onPreUpdate(){
        $this->setUpdatedDate(new \DateTime());

        if($this->filename === null || trim($this->filename) == ""){
            switch ($this->getRace()){
                case "Elfe" :
                    $this->setFilename("defaultElfe.jpg");
                    break;

                case "Troll":
                    $this->setFilename("defaultTroll.jpg");
                    break;

                case "Nain":
                    $this->setFilename("defaultNain.jpg");
                    break;

                default :
                    throw new Exception();
            }
        }
    }

    public function getFights(): ?array
    {
        return $this->fights;
    }

    public function setFights(?array $fights): self
    {
        $this->fights = $fights;

        return $this;
    }

    public function addFight(int $fightId): self
    {
        array_push($this->fights, $fightId );

        return $this;
    }

    public function getWinner(): ?bool
    {
        return $this->winner;
    }

    public function setWinner(bool $winner): self
    {
        $this->winner = $winner;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * @return String|null
     */
    public function getFilename(): ?String
    {
        return $this->filename;
    }

    /**
     * @param String|null $filename
     * @return Warrior
     */
    public function setFilename(?String $filename): Warrior
    {
        $this->filename = $filename;
        return $this;
    }

    /**
     * @return File|null
     */
    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    /**
     * @param File|null $imageFile
     * @return Warrior
     * @throws \Exception
     */
    public function setImageFile(?File $imageFile): Warrior
    {
        $this->imageFile = $imageFile;

        if ($this->imageFile instanceof UploadedFile) {
            $this->updatedDate = new \DateTime('now');
        }

        return $this;
    }






}
