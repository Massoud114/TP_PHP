<?php

namespace App\Entity;

use App\Repository\MuseeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=MuseeRepository::class)
 */
class Musee
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
	 * @Assert\NotBlank(message="Le champ ne peut etre vide")
	 * @Assert\Type(type="numeric", message="Entrez une valeur numérique")
	 * @Assert\Unique(message="Cette caleur existe déja")
	 */
    private $numMus;

    /**
     * @ORM\Column(type="string", length=255)
	 * @Assert\NotBlank(message="Le champ ne peut etre vide")
	 */
    private $nomMus;

    /**
     * @ORM\Column(type="integer")
	 * @Assert\NotBlank(message="Le champ ne peut etre vide")
	 * @Assert\Type(type="numeric", message="Entrez une valeur numérique")
	 */
    private $nbLivres;

    /**
     * @ORM\ManyToOne(targetEntity=Pays::class, inversedBy="musees")
     * @ORM\JoinColumn(nullable=false)
     */
    private $pays;

    /**
     * @ORM\OneToMany(targetEntity=Bibliotheque::class, mappedBy="numMus")
     */
    private $bibliotheques;

    public function __construct()
    {
        $this->bibliotheques = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumMus(): ?int
    {
        return $this->numMus;
    }

    public function setNumMus(int $numMus): self
    {
        $this->numMus = $numMus;

        return $this;
    }

    public function getNomMus(): ?string
    {
        return $this->nomMus;
    }

    public function setNomMus(string $nomMus): self
    {
        $this->nomMus = $nomMus;

        return $this;
    }

    public function getNbLivres(): ?int
    {
        return $this->nbLivres;
    }

    public function setNbLivres(int $nbLivres): self
    {
        $this->nbLivres = $nbLivres;

        return $this;
    }

    public function getPays(): ?Pays
    {
        return $this->pays;
    }

    public function setPays(?Pays $pays): self
    {
        $this->pays = $pays;

        return $this;
    }

    /**
     * @return Collection|Bibliotheque[]
     */
    public function getBibliotheques(): Collection
    {
        return $this->bibliotheques;
    }

    public function addBibliotheque(Bibliotheque $bibliotheque): self
    {
        if (!$this->bibliotheques->contains($bibliotheque)) {
            $this->bibliotheques[] = $bibliotheque;
            $bibliotheque->setNumMus($this);
        }

        return $this;
    }

    public function removeBibliotheque(Bibliotheque $bibliotheque): self
    {
        if ($this->bibliotheques->contains($bibliotheque)) {
            $this->bibliotheques->removeElement($bibliotheque);
            // set the owning side to null (unless already changed)
            if ($bibliotheque->getNumMus() === $this) {
                $bibliotheque->setNumMus(null);
            }
        }

        return $this;
    }
}
