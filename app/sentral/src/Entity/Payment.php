<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PaymentRepository")
 */
class Payment
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Activity")
     * @ORM\JoinColumn(nullable=false)
     */
    private $activity;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User")
     * @ORM\JoinColumn(nullable=false)
     */
    private $participant;

    /**
     * @ORM\Column(type="decimal", precision=15, scale=2)
     */
    private $amount;

    /**
     * @ORM\Column(type="datetimetz", nullable=true)
     */
    private $payedAt;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User")
     */
    private $payedBy;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getActivity(): ?Activity
    {
        return $this->activity;
    }

    public function setActivity(?Activity $activity): self
    {
        $this->activity = $activity;

        return $this;
    }

    public function getParticipant(): ?User
    {
        return $this->participant;
    }

    public function setParticipant(?User $participant): self
    {
        $this->participant = $participant;

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

    public function getPayedAt(): ?\DateTimeInterface
    {
        return $this->payedAt;
    }

    public function setPayedAt(?\DateTimeInterface $payedAt): self
    {
        $this->payedAt = $payedAt;

        return $this;
    }

    public function getPayedBy(): ?User
    {
        return $this->payedBy;
    }

    public function setPayedBy(?User $payedBy): self
    {
        $this->payedBy = $payedBy;

        return $this;
    }
}
