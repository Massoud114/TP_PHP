<?php

namespace App\Entity;

use App\Repository\PaysRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=PaysRepository::class)
 */
class Pays
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
	 * @Assert\NotBlank(message="Le champ ne peut etre vide")
	 */
    private $codePays;

    /**
     * @ORM\Column(type="integer")
	 * @Assert\Type(type="numeric", message="Entrez uen valeur numérique")
	 * @Assert\NotBlank(message="Le champ ne peut etre vide")
	 */
    private $nbHabitant;

    /**
     * @ORM\OneToMany(targetEntity=Musee::class, mappedBy="pays")
     */
    private $musees;

    /**
     * @ORM\OneToMany(targetEntity=Ouvrage::class, mappedBy="pays")
     */
    private $ouvrages;

    public function __construct()
    {
        $this->musees = new ArrayCollection();
        $this->ouvrages = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCodePays(): ?string
    {
        return $this->codePays;
    }

    public function setCodePays(string $codePays): self
    {
        $this->codePays = $codePays;

        return $this;
    }

    public function getNbHabitant(): ?int
    {
        return $this->nbHabitant;
    }

    public function setNbHabitant(int $nbHabitant): self
    {
        $this->nbHabitant = $nbHabitant;

        return $this;
    }

    /**
     * @return Collection|Musee[]
     */
    public function getMusees(): Collection
    {
        return $this->musees;
    }

    public function addMusee(Musee $musee): self
    {
        if (!$this->musees->contains($musee)) {
            $this->musees[] = $musee;
            $musee->setPays($this);
        }

        return $this;
    }

    public function removeMusee(Musee $musee): self
    {
        if ($this->musees->contains($musee)) {
            $this->musees->removeElement($musee);
            // set the owning side to null (unless already changed)
            if ($musee->getPays() === $this) {
                $musee->setPays(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Ouvrage[]
     */
    public function getOuvrages(): Collection
    {
        return $this->ouvrages;
    }

    public function addOuvrage(Ouvrage $ouvrage): self
    {
        if (!$this->ouvrages->contains($ouvrage)) {
            $this->ouvrages[] = $ouvrage;
            $ouvrage->setPays($this);
        }

        return $this;
    }

    public function removeOuvrage(Ouvrage $ouvrage): self
    {
        if ($this->ouvrages->contains($ouvrage)) {
            $this->ouvrages->removeElement($ouvrage);
            // set the owning side to null (unless already changed)
            if ($ouvrage->getPays() === $this) {
                $ouvrage->setPays(null);
            }
        }

        return $this;
    }
    public function __toString()
	{
		return $this->codePays;
	}
}
