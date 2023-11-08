<?php

namespace App\Tests\Entity;

use App\Entity\Ending;
use App\Entity\Event;
use App\Entity\EventType;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class EndingTest extends KernelTestCase
{
    protected static function getKernelClass()
    {
        return \App\Kernel::class;
    }

    public function getEntity(): Ending
    {
        $container = static::getContainer();
        $entityManager = $container->get('doctrine')->getManager();
        
        $eventRepository = $entityManager->getRepository(Event::class);
        $event = $eventRepository->find(3);

        $eventTypeRepository = $entityManager->getRepository(EventType::class);
        $eventType = $eventTypeRepository->find(1);

        return (new Ending())->setContent('Ending #1')
                             ->setEvent($event)
                             ->setEventType($eventType);
    }

    public function testEntityIsValid(): void
    {
        self::bootKernel();
        $container = static::getContainer();

        $entity = $this->getEntity();

        $errors = $container->get('validator')->validate($entity);
        $this->assertCount(0, $errors);
    }
}
