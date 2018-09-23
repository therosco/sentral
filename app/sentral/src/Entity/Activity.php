<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ActivityRepository")
 */
class Activity
{
    use TitleToString;
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="datetimetz", nullable=true)
     */
    private $startDate;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Category")
     * @ORM\JoinColumn(nullable=false)
     */
    private $category;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Organiser")
     */
    private $organiser;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $distance;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $travelTimeMinutes;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Venue")
     */
    private $venue;

    public function __construct()
    {
        $this->organiser = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

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

    public function getStartDate(): ?\DateTimeInterface
    {
        return $this->startDate;
    }

    public function setStartDate(?\DateTimeInterface $startDate): self
    {
        $this->startDate = $startDate;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }

    /**
     * @return Collection|Organiser[]
     */
    public function getOrganiser(): Collection
    {
        return $this->organiser;
    }

    public function addOrganiser(Organiser $organiser): self
    {
        if (!$this->organiser->contains($organiser)) {
            $this->organiser[] = $organiser;
        }

        return $this;
    }

    public function removeOrganiser(Organiser $organiser): self
    {
        if ($this->organiser->contains($organiser)) {
            $this->organiser->removeElement($organiser);
        }

        return $this;
    }

    public function getDistance(): ?float
    {
        return $this->distance;
    }

    public function setDistance(?float $distance): self
    {
        $this->distance = $distance;

        return $this;
    }

    public function getTravelTimeMinutes(): ?float
    {
        return $this->travelTimeMinutes;
    }

    public function setTravelTimeMinutes(?float $travelTimeMinutes): self
    {
        $this->travelTimeMinutes = $travelTimeMinutes;

        return $this;
    }

    public function getVenue(): ?Venue
    {
        return $this->venue;
    }

    public function setVenue(?Venue $venue): self
    {
        $this->venue = $venue;

        return $this;
    }
}
