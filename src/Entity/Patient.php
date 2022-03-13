<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use App\Controller\StatsController;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use App\Repository\PatientRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: PatientRepository::class)]
#[ApiResource(
    denormalizationContext: ["groups"=>["write:patient"]],
    normalizationContext: ["groups"=> ["read:patient"]]
)]
#[ApiFilter(
    SearchFilter::class, properties: ["lastName"=>"partial"]
)]
class Patient
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups(["read:patient", "write:patient"])]
    private $firstName;

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups(["read:patient", "write:patient"])]
    private $lastName;

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups(["read:patient", "write:patient"])]
    private $allergies;

    #[ORM\Column(type: 'float')]
    #[Groups(["read:patient", "write:patient"])]
    private $height;

    #[ORM\Column(type: 'float')]
    #[Groups(["read:patient", "write:patient"])]
    private $weight;

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups(["read:patient", "write:patient"])]
    private $socialNumber;

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups(["read:patient", "write:patient"])]
    private $notes;

    #[ORM\ManyToOne(targetEntity: Gender::class, inversedBy: 'patients')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(["read:patient", "write:patient"])]
    private $gender;

    #[ORM\ManyToOne(targetEntity: BloodGroup::class)]
    #[Groups(["read:patient", "write:patient"])]
    private $bloodGroup;

    #[ORM\OneToMany(mappedBy: 'patient', targetEntity: Document::class)]
    private $documents;

    #[ORM\ManyToOne(targetEntity: Treatment::class)]
    private $treatments;

    #[ORM\ManyToMany(targetEntity: Meet::class, mappedBy: 'patients')]
    private $meets;

    public function __construct()
    {
        $this->documents = new ArrayCollection();
        $this->meets = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getAllergies(): ?string
    {
        return $this->allergies;
    }

    public function setAllergies(string $allergies): self
    {
        $this->allergies = $allergies;

        return $this;
    }

    public function getHeight(): ?float
    {
        return $this->height;
    }

    public function setHeight(float $height): self
    {
        $this->height = $height;

        return $this;
    }

    public function getWeight(): ?float
    {
        return $this->weight;
    }

    public function setWeight(float $weight): self
    {
        $this->weight = $weight;

        return $this;
    }

    public function getSocialNumber(): ?int
    {
        return $this->socialNumber;
    }

    public function setSocialNumber(int $socialNumber): self
    {
        $this->socialNumber = $socialNumber;

        return $this;
    }

    public function getNotes(): ?string
    {
        return $this->notes;
    }

    public function setNotes(string $notes): self
    {
        $this->notes = $notes;

        return $this;
    }

    public function getGender(): ?Gender
    {
        return $this->gender;
    }

    public function setGender(?Gender $gender): self
    {
        $this->gender = $gender;

        return $this;
    }

    public function getBloodGroup(): ?BloodGroup
    {
        return $this->bloodGroup;
    }

    public function setBloodGroup(?BloodGroup $bloodGroup): self
    {
        $this->bloodGroup = $bloodGroup;

        return $this;
    }

    /**
     * @return Collection|Document[]
     */
    public function getDocuments(): Collection
    {
        return $this->documents;
    }

    public function addDocument(Document $document): self
    {
        if (!$this->documents->contains($document)) {
            $this->documents[] = $document;
            $document->setPatient($this);
        }

        return $this;
    }

    public function removeDocument(Document $document): self
    {
        if ($this->documents->removeElement($document)) {
            // set the owning side to null (unless already changed)
            if ($document->getPatient() === $this) {
                $document->setPatient(null);
            }
        }

        return $this;
    }

    public function getTreatments(): ?Treatment
    {
        return $this->treatments;
    }

    public function setTreatments(?Treatment $treatments): self
    {
        $this->treatments = $treatments;

        return $this;
    }

    /**
     * @return Collection|Meet[]
     */
    public function getMeets(): Collection
    {
        return $this->meets;
    }

    public function addMeet(Meet $meet): self
    {
        if (!$this->meets->contains($meet)) {
            $this->meets[] = $meet;
            $meet->addPatient($this);
        }

        return $this;
    }

    public function removeMeet(Meet $meet): self
    {
        if ($this->meets->removeElement($meet)) {
            $meet->removePatient($this);
        }

        return $this;
    }
}
