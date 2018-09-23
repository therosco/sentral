<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PermissionRepository")
 */
class Permission
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
     * @ORM\Column(type="datetimetz", nullable=true)
     */
    private $permittedAt;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User")
     */
    private $permittedBy;

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

    public function getPermittedAt(): ?\DateTimeInterface
    {
        return $this->permittedAt;
    }

    public function setPermittedAt(?\DateTimeInterface $permittedAt): self
    {
        $this->permittedAt = $permittedAt;

        return $this;
    }

    public function getPermittedBy(): ?User
    {
        return $this->permittedBy;
    }

    public function setPermittedBy(?User $permittedBy): self
    {
        $this->permittedBy = $permittedBy;

        return $this;
    }
}
