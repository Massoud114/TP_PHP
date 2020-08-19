<?php

namespace App\Entity;

use App\Repository\OuvrageRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=OuvrageRepository::class)
 */
class Ouvrage
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
	 */
    private $ISBN;

    /**
     * @ORM\Column(type="integer")
	 * @Assert\Type(type="numeric", message="Entrez une valeur numérique")
	 * @Assert\NotBlank(message="Le champ ne peut etre vide")
	 */
    private $nbPage;

    /**
     * @ORM\Column(type="string", length=255)
	 * @Assert\NotBlank(message="Le champ ne peut etre vide")
	 */
    private $titre;

    /**
     * @ORM\ManyToOne(targetEntity=Pays::class, inversedBy="ouvrages")
     * @ORM\JoinColumn(nullable=false)
     */
    private $pays;

    /**
     * @ORM\ManyToMany(targetEntity=Bibliotheque::class, mappedBy="ISBN")
     */
    private $bibliotheques;

    /**
     * @ORM\OneToMany(targetEntity=Referencer::class, mappedBy="isbn")
     */
    private $referencers;

    public function __construct()
    {
        $this->bibliotheques = new ArrayCollection();
        $this->referencers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getISBN(): ?int
    {
        return $this->ISBN;
    }

    public function setISBN(int $ISBN): self
    {
        $this->ISBN = $ISBN;

        return $this;
    }

    public function getNbPage(): ?int
    {
        return $this->nbPage;
    }

    public function setNbPage(int $nbPage): self
    {
        $this->nbPage = $nbPage;

        return $this;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

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
            $bibliotheque->addISBN($this);
        }

        return $this;
    }

    public function removeBibliotheque(Bibliotheque $bibliotheque): self
    {
        if ($this->bibliotheques->contains($bibliotheque)) {
            $this->bibliotheques->removeElement($bibliotheque);
            $bibliotheque->removeISBN($this);
        }

        return $this;
    }

    /**
     * @return Collection|Referencer[]
     */
    public function getReferencers(): Collection
    {
        return $this->referencers;
    }

    public function addReferencer(Referencer $referencer): self
    {
        if (!$this->referencers->contains($referencer)) {
            $this->referencers[] = $referencer;
            $referencer->setIsbn($this);
        }

        return $this;
    }

    public function removeReferencer(Referencer $referencer): self
    {
        if ($this->referencers->contains($referencer)) {
            $this->referencers->removeElement($referencer);
            // set the owning side to null (unless already changed)
            if ($referencer->getIsbn() === $this) {
                $referencer->setIsbn(null);
            }
        }

        return $this;
    }
}
