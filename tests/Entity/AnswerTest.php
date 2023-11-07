<?php

namespace App\Tests\Entity;

use App\Entity\Answer;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class AnswerTest extends KernelTestCase
{
    protected static function getKernelClass()
    {
        return \App\Kernel::class;
    }

    public function getEntity(): Answer
    {
        return (new Answer())->setContent('Answer #1');
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
