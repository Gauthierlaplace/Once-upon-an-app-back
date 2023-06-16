<?php

namespace App\Entity;

use App\Repository\EventRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\Groups;


/**
 * @ORM\Entity(repositoryClass=EventRepository::class)
 */
class Event
{
    
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"game_start", "game_event_roll"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Le champ Titre de l'évènement ne peut pas être vide")
     * @Groups({"game_start", "game_event_roll"})
     */
    private $title;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Groups({"game_start", "game_event_roll"})
     */
    private $description;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Groups({"game_start", "game_event_roll"})
     */
    private $opening;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"game_start", "game_event_roll"})
     */
    private $picture;

    /**
     * @ORM\ManyToOne(targetEntity=EventType::class, inversedBy="events")
     * @ORM\JoinColumn(nullable=false)
     * @Assert\NotBlank(message="Le champ Type d'évènement ne peut pas être vide")
     */
    private $eventType;

    /**
     * @ORM\ManyToOne(targetEntity=Biome::class, inversedBy="events")
     * @ORM\JoinColumn(nullable=false)
     * @Assert\NotBlank(message="Le champ Biome ne peut pas être vide")
     */
    private $biome;

    /**
     * @ORM\OneToMany(targetEntity=Ending::class, mappedBy="event")
     * 
     */
    private $endings;

    /**
     * @ORM\ManyToMany(targetEntity=Hero::class, mappedBy="event")
     */
    private $heroes;

    /**
     * @ORM\ManyToMany(targetEntity=Npc::class, inversedBy="events")
     */
    private $npc;

    public function __construct()
    {
        $this->endings = new ArrayCollection();
        $this->heroes = new ArrayCollection();
        $this->npc = new ArrayCollection();
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

    public function getOpening(): ?string
    {
        return $this->opening;
    }

    public function setOpening(?string $opening): self
    {
        $this->opening = $opening;

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

    public function getEventType(): ?EventType
    {
        return $this->eventType;
    }

    public function setEventType(?EventType $eventType): self
    {
        $this->eventType = $eventType;

        return $this;
    }

    public function getBiome(): ?Biome
    {
        return $this->biome;
    }

    public function setBiome(?Biome $biome): self
    {
        $this->biome = $biome;

        return $this;
    }

    /**
     * @return Collection<int, Ending>
     */
    public function getEndings(): Collection
    {
        return $this->endings;
    }

    public function addEnding(Ending $ending): self
    {
        if (!$this->endings->contains($ending)) {
            $this->endings[] = $ending;
            $ending->setEvent($this);
        }

        return $this;
    }

    public function removeEnding(Ending $ending): self
    {
        if ($this->endings->removeElement($ending)) {
            // set the owning side to null (unless already changed)
            if ($ending->getEvent() === $this) {
                $ending->setEvent(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Hero>
     */
    public function getHeroes(): Collection
    {
        return $this->heroes;
    }

    public function addHero(Hero $hero): self
    {
        if (!$this->heroes->contains($hero)) {
            $this->heroes[] = $hero;
            $hero->addEvent($this);
        }

        return $this;
    }

    public function removeHero(Hero $hero): self
    {
        if ($this->heroes->removeElement($hero)) {
            $hero->removeEvent($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Npc>
     */
    public function getNpc(): Collection
    {
        return $this->npc;
    }

    public function addNpc(Npc $npc): self
    {
        if (!$this->npc->contains($npc)) {
            $this->npc[] = $npc;
        }

        return $this;
    }

    public function removeNpc(Npc $npc): self
    {
        $this->npc->removeElement($npc);

        return $this;
    }
    public function __toString(): string
    {
        return $this->title;
    }
}
