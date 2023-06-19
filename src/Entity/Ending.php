<?php

namespace App\Entity;

use App\Repository\EndingRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=EndingRepository::class)
 */
class Ending
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Assert\NotBlank(message="Le champ Ending ne peut pas être vide")
     * @ORM\Column(type="text")
     */
    private $content;

    /**
     * @ORM\ManyToOne(targetEntity=Event::class, inversedBy="endings")
     * @ORM\JoinColumn(nullable=false)
     * @Assert\NotBlank(message="Le champ Evènement ne peut pas être vide")
     */
    private $event;

    /**
     * @ORM\ManyToOne(targetEntity=EventType::class, inversedBy="endings")
     * @ORM\JoinColumn(nullable=false)
     * @Assert\NotBlank(message="Le champ Type d'évènement ne peut pas être vide")
     */
    private $eventType;

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

    public function getEvent(): ?Event
    {
        return $this->event;
    }

    public function setEvent(?Event $event): self
    {
        $this->event = $event;

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
}
