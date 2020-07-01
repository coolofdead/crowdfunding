<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\ProjectRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *     collectionOperations={
 *          "get"={"normalization_context"={"groups"="project_payement"}},
 *     },
 *     attributes={
 *         "formats"={"jsonld", "json", "html", "csv"={"text/csv"}}
 *     }
 * )
 * 
 * @ApiFilter(SearchFilter::class, properties={"name": "ipartial"})
 * @ORM\Entity(repositoryClass=ProjectRepository::class)
 */
class Project
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups("project_payement")
     * @Groups("payement")
     */
    private $name;

    /**
     * @ORM\Column(type="date", nullable=true)
     * @Groups("project_payement")
     * @Groups("payement")
     */
    private $startDate;

    /**
     * @ORM\Column(type="date", nullable=true)
     * @Groups("project_payement")
     * @Groups("payement")
     */
    private $endDate;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups("project_payement")
     */
    private $picture;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Groups("project_payement")
     */
    private $description;

    /**
     * @ORM\Column(type="integer")
     * @Groups("project_payement")
     */
    private $goal;

    /**
     * @ORM\Column(type="date")
     */
    private $created;

    /**
     * @ORM\OneToMany(targetEntity=Payement::class, mappedBy="project")
     * @Groups("project_payement")
     */
    private $payements;

    public function __construct()
    {
        $this->payements = new ArrayCollection();
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

    public function getStartDate(): ?\DateTimeInterface
    {
        return $this->startDate;
    }

    public function setStartDate(?\DateTimeInterface $startDate): self
    {
        $this->startDate = $startDate;

        return $this;
    }

    public function getEndDate(): ?\DateTimeInterface
    {
        return $this->endDate;
    }

    public function setEndDate(?\DateTimeInterface $endDate): self
    {
        $this->endDate = $endDate;

        return $this;
    }

    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture(?string $picture): self
    {
        $this->picture = $picture;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getGoal(): ?int
    {
        return $this->goal;
    }

    public function setGoal(int $goal): self
    {
        $this->goal = $goal;

        return $this;
    }

    public function getCreated(): ?\DateTimeInterface
    {
        return $this->created;
    }

    public function setCreated(\DateTimeInterface $created): self
    {
        $this->created = $created;

        return $this;
    }

    /**
     * @return Collection|Payement[]
     */
    public function getPayements(): Collection
    {
        return $this->payements;
    }

    public function addPayement(Payement $payement): self
    {
        if (!$this->payements->contains($payement)) {
            $this->payements[] = $payement;
            $payement->setProject($this);
        }

        return $this;
    }

    public function removePayement(Payement $payement): self
    {
        if ($this->payements->contains($payement)) {
            $this->payements->removeElement($payement);
            // set the owning side to null (unless already changed)
            if ($payement->getProject() === $this) {
                $payement->setProject(null);
            }
        }

        return $this;
    }

    /**
     * @Groups("project_payement")
     */
    public function getCountPayements(): int
    {
        return count($this->payements);
    }
    
    /**
     * @Groups("project_payement")
     */
    public function getCurrentTotalAmount(): int
    {
        $total = 0;

        foreach ($this->payements as $payement) {
            $total += $payement->getAmount();
        }

        return $total;
    }
}
