<?php

namespace App\Entity;

use App\Repository\HeroRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=HeroRepository::class)
 */
class Hero
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Assert\NotBlank(message="Le champ Nom du héro ne peut pas être vide")
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @Assert\NotNull(message="Le champ Santé Maximum ne peut pas être vide")
     * @Assert\Type(type="numeric", message="Le champ Santé Maximum doit être un nombre")
     * @ORM\Column(type="integer")
     */
    private $maxHealth;

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

    /**
     * @Assert\Type(type="numeric", message="Le champ Expérience doit être un nombre")
     * @ORM\Column(type="integer", nullable=true)
     */
    private $xp;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $picture;

    /**
     * 
     * @Assert\Type(type="numeric", message="Le champ Niveau atteint doit être un nombre")
     * @ORM\Column(type="integer", nullable=true)
     */
    private $progress;

    /**
     * @ORM\ManyToOne(targetEntity=HeroClass::class, inversedBy="heroes")
     * @ORM\JoinColumn(nullable=false)
     * @Assert\NotBlank(message="Le champ Class ne peut pas être vide")
     */
    private $heroClass;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="heroes")
     * @ORM\JoinColumn(nullable=false)
     * @Assert\NotBlank(message="Le champ Utilisateur ne peut pas être vide")
     */
    private $user;

    /**
     * @ORM\ManyToMany(targetEntity=Item::class, inversedBy="heroes")
     */
    private $item;

    /**
     * @ORM\ManyToMany(targetEntity=Event::class, inversedBy="heroes")
     */
    private $event;

    public function __construct()
    {
        $this->item = new ArrayCollection();
        $this->event = new ArrayCollection();
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

    public function getMaxHealth(): ?int
    {
        return $this->maxHealth;
    }

    public function setMaxHealth(int $maxHealth): self
    {
        $this->maxHealth = $maxHealth;

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

    public function getXp(): ?int
    {
        return $this->xp;
    }

    public function setXp(?int $xp): self
    {
        $this->xp = $xp;

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

    public function getProgress(): ?int
    {
        return $this->progress;
    }

    public function setProgress(?int $progress): self
    {
        $this->progress = $progress;

        return $this;
    }

    public function getHeroClass(): ?HeroClass
    {
        return $this->heroClass;
    }

    public function setHeroClass(?HeroClass $heroClass): self
    {
        $this->heroClass = $heroClass;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

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
    public function getEvent(): Collection
    {
        return $this->event;
    }

    public function addEvent(Event $event): self
    {
        if (!$this->event->contains($event)) {
            $this->event[] = $event;
        }

        return $this;
    }

    public function removeEvent(Event $event): self
    {
        $this->event->removeElement($event);

        return $this;
    }

    public function __toString(): string
    {
        return $this->name;
    }
    
}
