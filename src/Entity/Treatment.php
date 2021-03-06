<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\TreatmentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TreatmentRepository::class)]
#[ApiResource(
    denormalizationContext: ["groups"=>["write:treatment"]],
    normalizationContext: ["groups"=> ["read:treatment"]],
)]
class Treatment
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'date')]
    #[Groups(["read:treatment", "write:treatment"])]
    private $startDate;

    #[ORM\Column(type: 'date')]
    #[Groups(["read:treatment", "write:treatment"])]
    private $endDate;

    #[ORM\Column(type: 'array')]
    #[Groups(["read:treatment", "write:treatment"])]
    private $repeats = [];

    #[ORM\ManyToMany(targetEntity: Drug::class)]
    private $drugs;

    #[ORM\ManyToOne(targetEntity: Patient::class)]
    private $patient;

    public function __construct()
    {
        $this->drugs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStartDate(): ?\DateTimeInterface
    {
        return $this->startDate;
    }

    public function setStartDate(\DateTimeInterface $startDate): self
    {
        $this->startDate = $startDate;

        return $this;
    }

    public function getEndDate(): ?\DateTimeInterface
    {
        return $this->endDate;
    }

    public function setEndDate(\DateTimeInterface $endDate): self
    {
        $this->endDate = $endDate;

        return $this;
    }

    public function getRepeats(): ?array
    {
        return $this->repeats;
    }

    public function setRepeats(array $repeats): self
    {
        $this->repeats = $repeats;

        return $this;
    }

    /**
     * @return Collection|Drug[]
     */
    public function getDrugs(): Collection
    {
        return $this->drugs;
    }

    public function addDrug(Drug $drug): self
    {
        if (!$this->drugs->contains($drug)) {
            $this->drugs[] = $drug;
        }

        return $this;
    }

    public function removeDrug(Drug $drug): self
    {
        $this->drugs->removeElement($drug);

        return $this;
    }

    public function getPatient(): ?self
    {
        return $this->patient;
    }

    public function setPatient(?Patient $patient): self
    {
        $this->patient = $patient;

        return $this;
    }
}
