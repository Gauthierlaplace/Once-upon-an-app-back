<?php

namespace App\Entity;

use App\Repository\PictureRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=PictureRepository::class)
 * @UniqueEntity(fields={"name"}, message="Vous ne pouvez pas ajouter un fichier avec le même nom.")
 */
class Picture
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * 
     * @Groups({"user_read", "user_create"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     * @Groups({"user_read", "user_create"})
     * @Groups({"game"})
     */
    private $name;

    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank(message="Le champ Image ne peut pas être vide")
     * @Assert\Regex(
     *     pattern="/^[a-zA-Z0-9\/+]+={0,2}$/",
     *     message="La valeur doit être une chaîne de caractères valide codée en base64"
     * )
     */
    private $base64;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"user_read", "user_create"})
     * @Groups({"game"})
     */
    private $path;

    /**
     * @ORM\OneToMany(targetEntity=Hero::class, mappedBy="picture")
     */
    private $heroes;

    /**
     * @ORM\OneToMany(targetEntity=User::class, mappedBy="avatar")
     */
    private $users;

    public function __construct()
    {
        $this->heroes = new ArrayCollection();
        $this->users = new ArrayCollection();
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

    public function getBase64(): ?string
    {
        return $this->base64;
    }

    public function setBase64(string $base64): self
    {
        $this->base64 = $base64;

        return $this;
    }

    public function getPath(): ?string
    {
        return $this->path;
    }

    public function setPath(string $path): self
    {
        $this->path = $path;

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
            $hero->setPicture($this);
        }

        return $this;
    }

    public function removeHero(Hero $hero): self
    {
        if ($this->heroes->removeElement($hero)) {
            // set the owning side to null (unless already changed)
            if ($hero->getPicture() === $this) {
                $hero->setPicture(null);
            }
        }

        return $this;
    }
    public function __toString(): string
    {
        return $this->name ?? ''; // Renvoie le nom de l'image s'il existe, sinon une chaîne vide
    }

    /**
     * @return Collection<int, User>
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users[] = $user;
            $user->setAvatar($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->removeElement($user)) {
            // set the owning side to null (unless already changed)
            if ($user->getAvatar() === $this) {
                $user->setAvatar(null);
            }
        }

        return $this;
    }
}
