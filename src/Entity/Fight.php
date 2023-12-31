<?php

namespace App\Entity;

use App\Repository\FightRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FightRepository::class)
 */
class Fight
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     */
    private $name;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $health;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $strength;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $intelligence;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $dexterity;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $defense;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $karma;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isBoss;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $hostility;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $xpEarned;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $maxHealth;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $item;

    /**
     * @ORM\OneToOne(targetEntity=Hero::class, mappedBy="fight", cascade={"persist", "remove"})
     */
    private $hero;

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

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getHealth(): ?int
    {
        return $this->health;
    }

    public function setHealth(?int $health): self
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

    public function isIsBoss(): ?bool
    {
        return $this->isBoss;
    }

    public function setIsBoss(bool $isBoss): self
    {
        $this->isBoss = $isBoss;

        return $this;
    }

    public function getHostility(): ?int
    {
        return $this->hostility;
    }

    public function setHostility(?int $hostility): self
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

    public function getMaxHealth(): ?int
    {
        return $this->maxHealth;
    }

    public function setMaxHealth(?int $maxHealth): self
    {
        $this->maxHealth = $maxHealth;

        return $this;
    }

    public function getItem(): ?int
    {
        return $this->item;
    }

    public function setItem(?int $item): self
    {
        $this->item = $item;

        return $this;
    }

    public function getHero(): ?Hero
    {
        return $this->hero;
    }

    public function setHero(?Hero $hero): self
    {
        // unset the owning side of the relation if necessary
        if ($hero === null && $this->hero !== null) {
            $this->hero->setFight(null);
        }

        // set the owning side of the relation if necessary
        if ($hero !== null && $hero->getFight() !== $this) {
            $hero->setFight($this);
        }

        $this->hero = $hero;

        return $this;
    }
}
