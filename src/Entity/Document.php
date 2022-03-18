<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\DocumentRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DocumentRepository::class)]
#[ApiResource]
class Document
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\Column(type: 'datetime')]
    private $uploadAt;

    #[ORM\Column(type: 'boolean')]
    private $isOrdonnance;

    #[ORM\ManyToOne(targetEntity: Patient::class, inversedBy: 'documents')]
    #[ORM\JoinColumn(nullable: false)]
    private $patient;

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

    public function getUploadAt(): ?\DateTime
    {
        return $this->uploadAt;
    }

    public function setUploadAt(\DateTime $uploadAt): self
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

    public function getPatient(): ?Patient
    {
        return $this->patient;
    }

    public function setPatient(?Patient $patient): self
    {
        $this->patient = $patient;

        return $this;
    }
}
