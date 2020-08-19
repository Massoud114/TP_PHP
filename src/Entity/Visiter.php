<?php

namespace App\Entity;

use App\Repository\VisiterRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=VisiterRepository::class)
 */
class Visiter
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Musee::class)
     * @ORM\JoinColumn(nullable=false)
	 * @Assert\NotBlank(message="Le champ ne peut etre vide")
     */
    private $musee;

    /**
     * @ORM\ManyToMany(targetEntity=Moment::class, inversedBy="visiters")
	 * @Assert\NotBlank(message="Le champ ne peut etre vide")
	 */
    private $jour;

    /**
     * @ORM\Column(type="integer")
	 * @Assert\NotBlank(message="Le champ ne peut etre vide")
	 * @Assert\Type(type="numeric", message="Entrez une valeur numeric")
	 */
    private $nbvisiteurs;

    public function __construct()
    {
        $this->jour = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMusee(): ?Musee
    {
        return $this->musee;
    }

    public function setMusee(?Musee $musee): self
    {
        $this->musee = $musee;

        return $this;
    }

    /**
     * @return Collection|Moment[]
     */
    public function getJour(): Collection
    {
        return $this->jour;
    }

    public function addJour(Moment $jour): self
    {
        if (!$this->jour->contains($jour)) {
            $this->jour[] = $jour;
        }

        return $this;
    }

    public function removeJour(Moment $jour): self
    {
        if ($this->jour->contains($jour)) {
            $this->jour->removeElement($jour);
        }

        return $this;
    }

    public function getNbvisiteurs(): ?int
    {
        return $this->nbvisiteurs;
    }

    public function setNbvisiteurs(int $nbvisiteurs): self
    {
        $this->nbvisiteurs = $nbvisiteurs;

        return $this;
    }
}
