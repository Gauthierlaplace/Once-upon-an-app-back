<?php

namespace App\Entity;

use App\Repository\ItemRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=ItemRepository::class)
 */
class Item
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"game"})
     */
    private $id;

    /**
     * @Assert\NotBlank(message="Le champ Nom de l'objet ne peut pas être vide")
     * @ORM\Column(type="string", length=255)
     * @Groups({"game"})
     */
    private $name;

    // /**
    //  * @ORM\Column(type="string", length=255, nullable=true)
    //  * @Groups({"game"})
    //  */
    // private $picture;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Assert\Type(type="numeric", message="Le champ Santé doit être un nombre")
     * @Groups({"game"})
     */
    private $health;

    /**
     * @Assert\Type(type="numeric", message="Le champ Force doit être un nombre")
     * @ORM\Column(type="integer", nullable=true)
     * @Groups({"game"})
     */
    private $strength;

    /**
     * @Assert\Type(type="numeric", message="Le champ Intelligence doit être un nombre")
     * @ORM\Column(type="integer", nullable=true)
     * @Groups({"game"})
     */
    private $intelligence;

    /**
     * @Assert\Type(type="numeric", message="Le champ Dextérité doit être un nombre")
     * @ORM\Column(type="integer", nullable=true)
     * @Groups({"game"})
     */
    private $dexterity;

    /**
     * @Assert\Type(type="numeric", message="Le champ Défense doit être un nombre")
     * @ORM\Column(type="integer", nullable=true)
     * @Groups({"game"})
     */
    private $defense;

    /**
     * @Assert\Type(type="numeric", message="Le champ Karma doit être un nombre")
     * @ORM\Column(type="integer", nullable=true)
     * @Groups({"game"})
     */
    private $karma;

    /**
     * @Assert\Type(type="numeric", message="Le champ Expérience doit être un nombre")
     * @ORM\Column(type="integer", nullable=true)
     * @Groups({"game"})
     */
    private $xp;

    /**
     * @ORM\ManyToMany(targetEntity=Hero::class, mappedBy="item")
     */
    private $heroes;

    /**
     * @ORM\ManyToMany(targetEntity=Npc::class, mappedBy="item")
     */
    private $npcs;

    /**
     * @ORM\OneToOne(targetEntity=Picture::class, cascade={"persist", "remove"})
     * @Groups({"game"})
     */
    private $picture;

    public function __construct()
    {
        $this->heroes = new ArrayCollection();
        $this->npcs = new ArrayCollection();
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

    // public function getPicture(): ?string
    // {
    //     return $this->picture;
    // }

    // public function setPicture(?string $picture): self
    // {
    //     $this->picture = $picture;

    //     return $this;
    // }

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

    public function getXp(): ?int
    {
        return $this->xp;
    }

    public function setXp(?int $xp): self
    {
        $this->xp = $xp;

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
            $hero->addItem($this);
        }

        return $this;
    }

    public function removeHero(Hero $hero): self
    {
        if ($this->heroes->removeElement($hero)) {
            $hero->removeItem($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Npc>
     */
    public function getNpcs(): Collection
    {
        return $this->npcs;
    }

    public function addNpc(Npc $npc): self
    {
        if (!$this->npcs->contains($npc)) {
            $this->npcs[] = $npc;
            $npc->addItem($this);
        }

        return $this;
    }

    public function removeNpc(Npc $npc): self
    {
        if ($this->npcs->removeElement($npc)) {
            $npc->removeItem($this);
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
}
