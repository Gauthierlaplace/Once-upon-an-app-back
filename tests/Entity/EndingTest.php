<?php

namespace App\Tests\Entity;

use App\Entity\Ending;
use App\Repository\EventRepository;
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
        // Récupérez l'EntityManager
        $entityManager = $container->get('doctrine')->getManager();

        // Utilisez l'EntityManager pour obtenir l'EventRepository
        $eventRepository = $entityManager->getRepository(Event::class);

        // Maintenant, vous pouvez utiliser le EventRepository
        $event = $eventRepository->find(3);

        return (new Ending())->setContent('Ending #1')
                             ->setEvent($event);
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
