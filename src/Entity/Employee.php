<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\EmployeeRepository;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass=EmployeeRepository::class)
 * @UniqueEntity(fields={"numero_cin"}, message="CIN déjà utilisée!")
 * @UniqueEntity(fields={"prenoms"}, message="Prénom déjà existante!")
 */
class Employee
{

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     * @Assert\Length(min=4)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=100)
     * @Assert\Length(min=2)
     */
    private $prenoms;

    /**
     * @ORM\Column(type="string",length=12)
     * @Assert\Regex(pattern="/^[1-9][0-9]{3}/",message="CIN non-valide")
     */
    private $numero_cin;

    /**
     * @ORM\Column(type="string", length=100) 
     */
    private $groupes;

    /**
     * @ORM\Column(type="string", length=100,nullable=true)
     */
    private $specialites;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $monday;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $tuesday;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $wednesday;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $thursday;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $friday;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $saturday;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $salaire;

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $status = [];

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $code_chantier;

    
    // public function __construct()
    // {
    //     $this->status = [0,0,0,0,0,0];
    // }

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

    public function getPrenoms(): ?string
    {
        return $this->prenoms;
    }

    public function setPrenoms(string $prenoms): self
    {
        $this->prenoms = $prenoms;

        return $this;
    }

    public function getNumeroCin(): ?int
    {
        return $this->numero_cin;
    }

    public function setNumeroCin(int $numero_cin): self
    {
        $this->numero_cin = $numero_cin;

        return $this;
    }

    public function getGroupes(): ?string
    {
        return $this->groupes;
    }

    public function setGroupes(string $groupes): self
    {
        $this->groupes = $groupes;

        return $this;
    }

    public function getSpecialites(): ?string
    {
        return $this->specialites;
    }

    public function setSpecialites(string $specialites): self
    {
        $this->specialites = $specialites;

        return $this;
    }

    public function getMonday(): ?bool
    {
        return $this->monday;
    }

    public function setMonday(?int $monday): self
    {
        $this->monday = $monday;

        return $this;
    }

    public function getTuesday(): ?bool
    {
        return $this->tuesday;
    }

    public function setTuesday(?int $tuesday): self
    {
        $this->tuesday = $tuesday;

        return $this;
    }

    public function getWednesday(): ?bool
    {
        return $this->wednesday;
    }

    public function setWednesday(?int $wednesday): self
    {
        $this->wednesday = $wednesday;

        return $this;
    }

    public function getThursday(): ?bool
    {
        return $this->thursday;
    }

    public function setThursday(?int $thursday): self
    {
        $this->thursday = $thursday;

        return $this;
    }

    public function getFriday(): ?bool
    {
        return $this->friday;
    }

    public function setFriday(?int $friday): self
    {
        $this->friday = $friday;

        return $this;
    }

    public function getSaturday(): ?bool
    {
        return $this->saturday;
    }

    public function setSaturday(?int $saturday): self
    {
        $this->saturday = $saturday;

        return $this;
    }

    public function getSalaire(): ?int
    {
        return ($this->monday + $this->tuesday + $this->wednesday + $this->thursday + $this->friday + $this->saturday)*$this->salaire;
    }

    public function setSalaire(?int $salaire): self
    {
        $this->salaire = $salaire;

        return $this;
    }

    public function getStatus(): ?array
    {
        return $this->status;
    }

    public function setStatus(?array $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getCodeChantier(): ?string
    {
        return $this->code_chantier;
    }

    public function setCodeChantier(string $code_chantier): self
    {
        $this->code_chantier = $code_chantier;

        return $this;
    }
}
