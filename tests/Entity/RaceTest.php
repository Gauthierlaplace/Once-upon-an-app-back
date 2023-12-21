<?php

namespace App\Tests;

use App\Entity\Npc;
use App\Entity\Race;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class RaceTest extends KernelTestCase
{
    protected static function getKernelClass()
    {
        return \App\Kernel::class;
    }

    public function getEntity(): Race
    {
        $container = static::getContainer();
        $entityManager = $container->get('doctrine')->getManager();
        $npcRepository = $entityManager->getRepository(Npc::class);
        $npc = $npcRepository->find(10);

        return (new Race())->setName('Race #1')
            ->setDescription('Description #1')
            ->addNpc($npc);
    }

    public function testEntityIsValid(): void
    {
        self::bootKernel();
        $container = static::getContainer();

        $entity = $this->getEntity();

        $errors = $container->get('validator')->validate($entity);
        $this->assertCount(0, $errors);
    }

    public function testEntityGetters(): void
    {
        self::bootKernel();
        $container = static::getContainer();

        $entityManager = $container->get('doctrine')->getManager();

        $raceRepository = $entityManager->getRepository(Race::class);
        $race = $raceRepository->find(1);
        $race->getId();
        $race->getNpcs(10);

        $entity = $race->setName($race->getName())
            ->setDescription($race->getDescription());

        $errors = $container->get('validator')->validate($entity);
        $this->assertCount(0, $errors);
    }

    public function testEntityRemoveNpc(): void
    {
        self::bootKernel();
        $container = static::getContainer();

        $entityManager = $container->get('doctrine')->getManager();

        $raceRepository = $entityManager->getRepository(Race::class);
        $race = $raceRepository->find(1);

        $npcRepository = $entityManager->getRepository(Npc::class);
        $npc = $npcRepository->find(10);
        $race->removeNpc($npc);

        $entity = $race->setName($race->getName())
            ->setDescription($race->getDescription());

        $errors = $container->get('validator')->validate($entity);
        $this->assertCount(0, $errors);
    }
}