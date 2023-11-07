<?php

namespace App\Tests\Entity;

use App\Entity\Dialogue;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class DialogueTest extends KernelTestCase
{
    protected static function getKernelClass()
    {
        return \App\Kernel::class;
    }

    public function getEntity(): Dialogue
    {
        return (new Dialogue())->setContent('Dialogue #1');
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
