<?php

namespace App\Entity;

use App\Repository\BiomeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=BiomeRepository::class)
 */
class Biome
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Assert\NotBlank(message="Le champ Nom du biome ne peut pas être vide")
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @Assert\NotNull(message="Le champ Niveau de difficulté ne peut pas être vide")
     * @Assert\Type(type="numeric", message="Le champ Niveau de difficulté doit être un nombre")
     * @ORM\Column(type="integer")
     */
    private $difficulty;

    /**
     * @ORM\OneToMany(targetEntity=Event::class, mappedBy="biome")
     */
    private $events;

    public function __construct()
    {
        $this->events = new ArrayCollection();
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

    public function getDifficulty(): ?int
    {
        return $this->difficulty;
    }

    public function setDifficulty(int $difficulty): self
    {
        $this->difficulty = $difficulty;

        return $this;
    }

    /**
     * @return Collection<int, Event>
     */
    public function getEvents(): Collection
    {
        return $this->events;
    }

    public function addEvent(Event $event): self
    {
        if (!$this->events->contains($event)) {
            $this->events[] = $event;
            $event->setBiome($this);
        }

        return $this;
    }

    public function removeEvent(Event $event): self
    {
        if ($this->events->removeElement($event)) {
            // set the owning side to null (unless already changed)
            if ($event->getBiome() === $this) {
                $event->setBiome(null);
            }
        }

        return $this;
    }
    public function __toString(): string
    {
        return $this->name;
    }
}
