<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\PayementRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=PayementRepository::class)
 */
class Payement
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $donator_name;

    /**
     * @ORM\Column(type="integer")
     */
    private $amount;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $comment;

    /**
     * @ORM\Column(type="date")
     */
    private $payement_date;

    /**
     * @ORM\Column(type="date")
     */
    private $created;

    /**
     * @ORM\ManyToOne(targetEntity=Project::class, inversedBy="payements")
     */
    private $project;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDonatorName(): ?string
    {
        return $this->donator_name;
    }

    public function setDonatorName(string $donator_name): self
    {
        $this->donator_name = $donator_name;

        return $this;
    }

    public function getAmount(): ?int
    {
        return $this->amount;
    }

    public function setAmount(int $amount): self
    {
        $this->amount = $amount;

        return $this;
    }

    public function getComment(): ?string
    {
        return $this->comment;
    }

    public function setComment(?string $comment): self
    {
        $this->comment = $comment;

        return $this;
    }

    public function getPayementDate(): ?\DateTimeInterface
    {
        return $this->payement_date;
    }

    public function setPayementDate(\DateTimeInterface $payement_date): self
    {
        $this->payement_date = $payement_date;

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

    public function getProject(): ?Project
    {
        return $this->project;
    }

    public function setProject(?Project $project): self
    {
        $this->project = $project;

        return $this;
    }
}
