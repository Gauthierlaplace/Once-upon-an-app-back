<?php

namespace App\Tests\Entity;

use App\Entity\Biome;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class BiomeTest extends KernelTestCase
{
    protected static function getKernelClass()
    {
        return \App\Kernel::class;
    }

    public function getEntity(): Biome
    {
        return (new Biome())->setName('Biome #1')
                    ->setDifficulty(1);
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
