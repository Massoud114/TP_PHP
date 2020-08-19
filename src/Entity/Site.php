<?php

namespace App\Entity;

use App\Repository\SiteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=SiteRepository::class)
 */
class Site
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
	 * @Assert\Length(min="3", max="255", minMessage="Entrez une valeur entre 3 et 255", maxMessage="Entrez une valeur
	 * entre 3 et 255")
	 * @Assert\Unique(message="Cette valeur existe déja")
	 */
    private $nomSite;

    /**
     * @ORM\Column(type="integer")
	 * @Assert\NotBlank(message="Le champ ne peut etre vide")
	 * @Assert\Type(type="numeric", message="Entrez une valeur numérique")
	 */
    private $anneedecouv;

    /**
     * @ORM\ManyToOne(targetEntity=Pays::class)
     * @ORM\JoinColumn(nullable=false)
	 * @Assert\NotBlank(message="Le champ ne peut etre vide")
	 */
    private $pays;

    /**
     * @ORM\ManyToMany(targetEntity=Referencer::class, mappedBy="site")
     */
    private $referencers;

    public function __construct()
    {
        $this->referencers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomSite(): ?string
    {
        return $this->nomSite;
    }

    public function setNomSite(string $nomSite): self
    {
        $this->nomSite = $nomSite;

        return $this;
    }

    public function getAnneedecouv(): ?int
    {
        return $this->anneedecouv;
    }

    public function setAnneedecouv(int $anneedecouv): self
    {
        $this->anneedecouv = $anneedecouv;

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
            $referencer->addSite($this);
        }

        return $this;
    }

    public function removeReferencer(Referencer $referencer): self
    {
        if ($this->referencers->contains($referencer)) {
            $this->referencers->removeElement($referencer);
            $referencer->removeSite($this);
        }

        return $this;
    }
}
