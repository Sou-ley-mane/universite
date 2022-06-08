<?php

namespace App\Entity;

use App\Repository\EtudiantRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EtudiantRepository::class)]
class Etudiant extends User
{
    

    #[ORM\Column(type: 'string', length: 255)]
    private $matricule;

    #[ORM\Column(type: 'string', length: 255)]
    private $adresse;

    #[ORM\Column(type: 'string', length: 10)]
    private $sexe;

    #[ORM\OneToMany(mappedBy: 'etudiant', targetEntity: Demande::class)]
    private $demandes;

    #[ORM\OneToMany(mappedBy: 'etudiant', targetEntity: Inscription::class)]
    private $inscripions;

    public function __construct()
    {
        $this->demandes = new ArrayCollection();
        $this->inscripions = new ArrayCollection();
    }



    public function getMatricule(): ?string
    {
        return $this->matricule;
    }

    public function setMatricule(string $matricule): self
    {
        $this->matricule = $matricule;

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

    public function getSexe(): ?string
    {
        return $this->sexe;
    }

    public function setSexe(string $sexe): self
    {
        $this->sexe = $sexe;

        return $this;
    }

    /**
     * @return Collection<int, Demande>
     */
    public function getDemandes(): Collection
    {
        return $this->demandes;
    }

    public function addDemande(Demande $demande): self
    {
        if (!$this->demandes->contains($demande)) {
            $this->demandes[] = $demande;
            $demande->setEtudiant($this);
        }

        return $this;
    }

    public function removeDemande(Demande $demande): self
    {
        if ($this->demandes->removeElement($demande)) {
            // set the owning side to null (unless already changed)
            if ($demande->getEtudiant() === $this) {
                $demande->setEtudiant(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Inscription>
     */
    public function getInscripions(): Collection
    {
        return $this->inscripions;
    }

    public function addInscripion(Inscription $inscripion): self
    {
        if (!$this->inscripions->contains($inscripion)) {
            $this->inscripions[] = $inscripion;
            $inscripion->setEtudiant($this);
        }

        return $this;
    }

    public function removeInscripion(Inscription $inscripion): self
    {
        if ($this->inscripions->removeElement($inscripion)) {
            // set the owning side to null (unless already changed)
            if ($inscripion->getEtudiant() === $this) {
                $inscripion->setEtudiant(null);
            }
        }

        return $this;
    }
}
