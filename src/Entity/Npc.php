<?php

namespace App\Entity;

use App\Repository\NpcRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=NpcRepository::class)
 */
class Npc
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Assert\NotBlank(message="Le champ Nom du personnage ne peut pas être vide")
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @Assert\NotNull(message="Le champ Santé ne peut pas être vide")
     * @Assert\Type(type="numeric", message="Le champ Santé doit être un nombre")
     * @ORM\Column(type="integer")
     */
    private $health;

    /**
     * @Assert\Type(type="numeric", message="Le champ Force doit être un nombre")
     * @ORM\Column(type="integer", nullable=true)
     */
    private $strength;

    /**
     * @Assert\Type(type="numeric", message="Le champ Intelligence doit être un nombre")
     * @ORM\Column(type="integer", nullable=true)
     */
    private $intelligence;

    /**
     * @Assert\Type(type="numeric", message="Le champ Dextérité doit être un nombre")
     * @ORM\Column(type="integer", nullable=true)
     */
    private $dexterity;

    /**
     * @Assert\Type(type="numeric", message="Le champ Défense doit être un nombre")
     * @ORM\Column(type="integer", nullable=true)
     */
    private $defense;

    /**
     * @Assert\Type(type="numeric", message="Le champ Karma doit être un nombre")
     * @ORM\Column(type="integer", nullable=true)
     */
    private $karma;

    // /**
    //  * @ORM\Column(type="string", length=255, nullable=true)
    //  */
    // private $picture;

    /**
     * @Assert\NotNull(message="Veuillez sélectionner au moins une réponse!")
     * @ORM\Column(type="boolean")
     */
    private $isBoss;

    /**
     * @Assert\NotNULL(message="Veuillez sélectionner au moins une réponse!")
     * @ORM\Column(type="boolean")
     */
    private $hostility;

    /**
     * @Assert\Type(type="numeric", message="Le champ Expérience doit être un nombre")
     * @ORM\Column(type="integer", nullable=true)
     */
    private $xpEarned;

    /**
     * @Assert\NotBlank(message="Le champ Race ne peut pas être vide")
     * @ORM\ManyToOne(targetEntity=Race::class, inversedBy="npcs")
     * @ORM\JoinColumn(nullable=false)
     */
    private $race;

    /**
     * @ORM\OneToMany(targetEntity=Dialogue::class, mappedBy="npc")
     */
    private $dialogues;

    /**
     * @ORM\ManyToMany(targetEntity=Item::class, inversedBy="npcs")
     */
    private $item;

    /**
     * @ORM\ManyToMany(targetEntity=Event::class, mappedBy="npc")
     */
    private $events;

    /**
     * @ORM\OneToOne(targetEntity=Picture::class, cascade={"persist", "remove"})
     */
    private $picture;

    /**
     * @Assert\Type(type="numeric", message="Le champ Santé Maximum doit être un nombre")
     * @ORM\Column(type="integer", nullable=true)
     */
    private $maxHealth;

    public function __construct()
    {
        $this->dialogues = new ArrayCollection();
        $this->item = new ArrayCollection();
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getHealth(): ?int
    {
        return $this->health;
    }

    public function setHealth(int $health): self
    {
        $this->health = $health;

        return $this;
    }

    public function getStrength(): ?int
    {
        return $this->strength;
    }

    public function setStrength(?int $strength): self
    {
        $this->strength = $strength;

        return $this;
    }

    public function getIntelligence(): ?int
    {
        return $this->intelligence;
    }

    public function setIntelligence(?int $intelligence): self
    {
        $this->intelligence = $intelligence;

        return $this;
    }

    public function getDexterity(): ?int
    {
        return $this->dexterity;
    }

    public function setDexterity(?int $dexterity): self
    {
        $this->dexterity = $dexterity;

        return $this;
    }

    public function getDefense(): ?int
    {
        return $this->defense;
    }

    public function setDefense(?int $defense): self
    {
        $this->defense = $defense;

        return $this;
    }

    public function getKarma(): ?int
    {
        return $this->karma;
    }

    public function setKarma(?int $karma): self
    {
        $this->karma = $karma;

        return $this;
    }

    // public function getPicture(): ?string
    // {
    //     return $this->picture;
    // }

    // public function setPicture(?string $picture): self
    // {
    //     $this->picture = $picture;

    //     return $this;
    // }

    public function isIsBoss(): ?bool
    {
        return $this->isBoss;
    }

    public function setIsBoss(bool $isBoss): self
    {
        $this->isBoss = $isBoss;

        return $this;
    }

    public function isHostility(): ?bool
    {
        return $this->hostility;
    }

    public function setHostility(bool $hostility): self
    {
        $this->hostility = $hostility;

        return $this;
    }

    public function getXpEarned(): ?int
    {
        return $this->xpEarned;
    }

    public function setXpEarned(?int $xpEarned): self
    {
        $this->xpEarned = $xpEarned;

        return $this;
    }

    public function getRace(): ?Race
    {
        return $this->race;
    }

    public function setRace(?Race $race): self
    {
        $this->race = $race;

        return $this;
    }

    /**
     * @return Collection<int, Dialogue>
     */
    public function getDialogues(): Collection
    {
        return $this->dialogues;
    }

    public function addDialogue(Dialogue $dialogue): self
    {
        if (!$this->dialogues->contains($dialogue)) {
            $this->dialogues[] = $dialogue;
            $dialogue->setNpc($this);
        }

        return $this;
    }

    public function removeDialogue(Dialogue $dialogue): self
    {
        if ($this->dialogues->removeElement($dialogue)) {
            // set the owning side to null (unless already changed)
            if ($dialogue->getNpc() === $this) {
                $dialogue->setNpc(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Item>
     */
    public function getItem(): Collection
    {
        return $this->item;
    }

    public function addItem(Item $item): self
    {
        if (!$this->item->contains($item)) {
            $this->item[] = $item;
        }

        return $this;
    }

    public function removeItem(Item $item): self
    {
        $this->item->removeElement($item);

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
            $event->addNpc($this);
        }

        return $this;
    }

    public function removeEvent(Event $event): self
    {
        if ($this->events->removeElement($event)) {
            $event->removeNpc($this);
        }

        return $this;
    }

    public function __toString(): string
    {
        return $this->name;
    }

    public function getPicture(): ?Picture
    {
        return $this->picture;
    }

    public function setPicture(?Picture $picture): self
    {
        $this->picture = $picture;

        return $this;
    }

    public function getMaxHealth(): ?int
    {
        return $this->maxHealth;
    }

    public function setMaxHealth(?int $maxHealth): self
    {
        $this->maxHealth = $maxHealth;

        return $this;
    }
}
