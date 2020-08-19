<?php

namespace App\Entity;

use App\Repository\ReferencerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=ReferencerRepository::class)
 */
class Referencer
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToMany(targetEntity=Site::class, inversedBy="referencers")
     */
    private $site;

    /**
     * @ORM\ManyToOne(targetEntity=Ouvrage::class, inversedBy="referencers")
     */
    private $isbn;

    /**
     * @ORM\Column(type="integer")
	 * @Assert\Type(type="numeric", message="Entrez une valeur numérique")
     */
    private $numeroPage;

    public function __construct()
    {
        $this->site = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|Site[]
     */
    public function getSite(): Collection
    {
        return $this->site;
    }

    public function addSite(Site $site): self
    {
        if (!$this->site->contains($site)) {
            $this->site[] = $site;
        }

        return $this;
    }

    public function removeSite(Site $site): self
    {
        if ($this->site->contains($site)) {
            $this->site->removeElement($site);
        }

        return $this;
    }

    public function getIsbn(): ?Ouvrage
    {
        return $this->isbn;
    }

    public function setIsbn(?Ouvrage $isbn): self
    {
        $this->isbn = $isbn;

        return $this;
    }

    public function getNumeroPage(): ?int
    {
        return $this->numeroPage;
    }

    public function setNumeroPage(int $numeroPage): self
    {
        $this->numeroPage = $numeroPage;

        return $this;
    }
}
