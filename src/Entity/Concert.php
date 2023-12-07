<?php

namespace App\Entity;

use App\Repository\ConcertRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ConcertRepository::class)]
class Concert
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'datetime')]
    private $dateConcert;

    #[ORM\Column(type: 'text', nullable: true)]
    private $description;

    #[ORM\Column(type: 'float')]
    private $tarif;

    #[ORM\ManyToOne(targetEntity: Artiste::class, inversedBy: 'concerts')]
    #[ORM\JoinColumn(nullable: false)]
    private $artiste;

    /**
     * Concert constructor.
     * @param $dateConcert
     * @param $description
     * @param $tarif
     */
    public function __construct($dateConcert=null, $description="", $tarif=15)
    {
        $this->dateConcert = $dateConcert;
        $this->description = $description;
        $this->tarif = $tarif;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateConcert(): ?\DateTimeInterface
    {
        return $this->dateConcert;
    }

    public function setDateConcert(\DateTimeInterface $dateConcert): self
    {
        $this->dateConcert = $dateConcert;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getTarif(): ?float
    {
        return $this->tarif;
    }

    public function setTarif(float $tarif): self
    {
        $this->tarif = $tarif;

        return $this;
    }

    public function getArtiste(): ?Artiste
    {
        return $this->artiste;
    }

    public function setArtiste(?Artiste $artiste): self
    {
        $this->artiste = $artiste;

        return $this;
    }
}
