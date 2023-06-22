<?php

namespace App\Entity;

use App\Repository\HeroClassRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=HeroClassRepository::class)
 */
class HeroClass
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Assert\NotBlank(message="Le champ Nom de la classe de héro ne peut pas être vide")
     * @ORM\Column(type="string", length=255)
     * @Groups({"game"})
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
     * @ORM\OneToMany(targetEntity=Hero::class, mappedBy="heroClass")
     */
    private $heroes;

    public function __construct()
    {
        $this->heroes = new ArrayCollection();
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
            $hero->setHeroClass($this);
        }

        return $this;
    }

    public function removeHero(Hero $hero): self
    {
        if ($this->heroes->removeElement($hero)) {
            // set the owning side to null (unless already changed)
            if ($hero->getHeroClass() === $this) {
                $hero->setHeroClass(null);
            }
        }

        return $this;
    }
    public function __toString(): string
    {
        return $this->name;
    }
}
