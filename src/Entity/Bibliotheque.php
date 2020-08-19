<?php

namespace App\Entity;

use App\Repository\BibliothequeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=BibliothequeRepository::class)
 */
class Bibliotheque
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Musee::class, inversedBy="bibliotheques")
     */
    private $numMus;

    /**
     * @ORM\ManyToMany(targetEntity=Ouvrage::class, inversedBy="bibliotheques")
     */
    private $ISBN;

    /**
     * @ORM\Column(type="date")
	 * @Assert\NotBlank(message="Le champ ne peut etre vide")
	 * @Assert\Date(message="Entre une date valide")
	 */
    private $dateAchat;

    public function __construct()
    {
        $this->ISBN = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumMus(): ?Musee
    {
        return $this->numMus;
    }

    public function setNumMus(?Musee $numMus): self
    {
        $this->numMus = $numMus;

        return $this;
    }

    /**
     * @return Collection|Ouvrage[]
     */
    public function getISBN(): Collection
    {
        return $this->ISBN;
    }

    public function addISBN(Ouvrage $iSBN): self
    {
        if (!$this->ISBN->contains($iSBN)) {
            $this->ISBN[] = $iSBN;
        }

        return $this;
    }

    public function removeISBN(Ouvrage $iSBN): self
    {
        if ($this->ISBN->contains($iSBN)) {
            $this->ISBN->removeElement($iSBN);
        }

        return $this;
    }

    public function getDateAchat(): ?\DateTimeInterface
    {
        return $this->dateAchat;
    }

    public function setDateAchat(\DateTimeInterface $dateAchat): self
    {
        $this->dateAchat = $dateAchat;

        return $this;
    }
}
