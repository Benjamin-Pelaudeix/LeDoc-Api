<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\TourRepository;
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

    #[ORM\ManyToOne(targetEntity: Meet::class)]
    private $meets;

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
}
