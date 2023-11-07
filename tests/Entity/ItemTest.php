<?php

namespace App\Tests\Entity;

use App\Entity\Item;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class ItemTest extends KernelTestCase
{
    protected static function getKernelClass()
    {
        return \App\Kernel::class;
    }

    public function getEntity(): Item
    {
        return (new Item())->setName('Item #1')
                    ->setHealth(100)
                    ->setStrength(100)
                    ->setIntelligence(100)
                    ->setDexterity(100)
                    ->setDefense(100)
                    ->setKarma(100)
                    ->setXp(100);
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
