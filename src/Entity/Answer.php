<?php

namespace App\Entity;

use App\Repository\AnswerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AnswerRepository::class)
 */
class Answer
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
    private $content;

    /**
     * @ORM\ManyToOne(targetEntity=Dialogue::class, inversedBy="answers")
     * @ORM\JoinColumn(nullable=false)
     */
    private $dialogue;

    /**
     * @ORM\ManyToMany(targetEntity=Effect::class, inversedBy="answers")
     */
    private $effect;

    public function __construct()
    {
        $this->effect = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getDialogue(): ?Dialogue
    {
        return $this->dialogue;
    }

    public function setDialogue(?Dialogue $dialogue): self
    {
        $this->dialogue = $dialogue;

        return $this;
    }

    /**
     * @return Collection<int, Effect>
     */
    public function getEffect(): Collection
    {
        return $this->effect;
    }

    public function addEffect(Effect $effect): self
    {
        if (!$this->effect->contains($effect)) {
            $this->effect[] = $effect;
        }

        return $this;
    }

    public function removeEffect(Effect $effect): self
    {
        $this->effect->removeElement($effect);

        return $this;
    }
}
