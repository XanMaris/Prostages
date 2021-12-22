<?php

namespace App\Entity;

use App\Repository\EntrepriseRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EntrepriseRepository::class)
 */
class Entreprise
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=130)
     */
    private $adresse;

    /**
     * @ORM\Column(type="string", length=200)
     */
    private $activit├®;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $URLsite;

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

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getActivit├®(): ?string
    {
        return $this->activit├®;
    }

    public function setActivit├®(string $activit├®): self
    {
        $this->activit├® = $activit├®;

        return $this;
    }

    public function getURLsite(): ?string
    {
        return $this->URLsite;
    }

    public function setURLsite(string $URLsite): self
    {
        $this->URLsite = $URLsite;

        return $this;
    }
}
