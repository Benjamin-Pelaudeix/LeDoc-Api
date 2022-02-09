<?php

namespace App\Entity;

use App\Repository\DocumentRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DocumentRepository::class)]
class Document
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\Column(type: 'datetime_immutable')]
    private $uploadAt;

    #[ORM\Column(type: 'boolean')]
    private $isOrdonnance;

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

    public function getUploadAt(): ?\DateTimeImmutable
    {
        return $this->uploadAt;
    }

    public function setUploadAt(\DateTimeImmutable $uploadAt): self
    {
        $this->uploadAt = $uploadAt;

        return $this;
    }

    public function getIsOrdonnance(): ?bool
    {
        return $this->isOrdonnance;
    }

    public function setIsOrdonnance(bool $isOrdonnance): self
    {
        $this->isOrdonnance = $isOrdonnance;

        return $this;
    }
}
