<?php

namespace App\Entity;

use App\Repository\EventTypeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EventTypeRepository::class)
 */
class EventType
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity=Event::class, mappedBy="eventType")
     */
    private $events;

    /**
     * @ORM\OneToMany(targetEntity=Ending::class, mappedBy="eventType")
     */
    private $endings;

    public function __construct()
    {
        $this->events = new ArrayCollection();
        $this->endings = new ArrayCollection();
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
            $event->setEventType($this);
        }

        return $this;
    }

    public function removeEvent(Event $event): self
    {
        if ($this->events->removeElement($event)) {
            // set the owning side to null (unless already changed)
            if ($event->getEventType() === $this) {
                $event->setEventType(null);
            }
        }

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
            $ending->setEventType($this);
        }

        return $this;
    }

    public function removeEnding(Ending $ending): self
    {
        if ($this->endings->removeElement($ending)) {
            // set the owning side to null (unless already changed)
            if ($ending->getEventType() === $this) {
                $ending->setEventType(null);
            }
        }

        return $this;
    }
}
