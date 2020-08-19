<?php

namespace App\Entity;

use App\Repository\MomentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=MomentRepository::class)
 */
class Moment
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
	 * @Assert\NotBlank(message="Le champ ne peut etre vide")
	 */
    private $jour;

    /**
     * @ORM\ManyToMany(targetEntity=Visiter::class, mappedBy="jour")
     */
    private $visiters;

    public function __construct()
    {
        $this->visiters = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getJour(): ?\DateTimeInterface
    {
        return $this->jour;
    }

    public function setJour(\DateTimeInterface $jour): self
    {
        $this->jour = $jour;

        return $this;
    }

    /**
     * @return Collection|Visiter[]
     */
    public function getVisiters(): Collection
    {
        return $this->visiters;
    }

    public function addVisiter(Visiter $visiter): self
    {
        if (!$this->visiters->contains($visiter)) {
            $this->visiters[] = $visiter;
            $visiter->addJour($this);
        }

        return $this;
    }

    public function removeVisiter(Visiter $visiter): self
    {
        if ($this->visiters->contains($visiter)) {
            $this->visiters->removeElement($visiter);
            $visiter->removeJour($this);
        }

        return $this;
    }
}
