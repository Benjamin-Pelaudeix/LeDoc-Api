<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\TourRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TourRepository::class)]
#[ApiResource(
    denormalizationContext: ["groups"=>["write:tour"]],
    normalizationContext: ["groups"=> ["read:tour"]],
)]
class Tour
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups(["read:tour", "write:tour"])]
    private $name;

    #[ORM\Column(type: 'datetime')]
    #[Groups(["read:tour", "write:tour"])]
    private $date;

    #[ORM\OneToMany(mappedBy: 'tour', targetEntity: Meet::class)]
    private $meets;

    public function __construct()
    {
        $this->meets = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getMeets(): ?Meet
    {
        return $this->meets;
    }

    public function setMeets(?Meet $meets): self
    {
        $this->meets = $meets;

        return $this;
    }

    public function addMeet(Meet $meet): self
    {
        if (!$this->meets->contains($meet)) {
            $this->meets[] = $meet;
            $meet->setTour($this);
        }

        return $this;
    }

    public function removeMeet(Meet $meet): self
    {
        if ($this->meets->removeElement($meet)) {
            // set the owning side to null (unless already changed)
            if ($meet->getTour() === $this) {
                $meet->setTour(null);
            }
        }

        return $this;
    }
}
