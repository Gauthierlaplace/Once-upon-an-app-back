<?php

namespace App\Tests;

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
        return (new Race())->setName('Race #1')
                    ->setDescription('Description #1');
    }

    public function testEntityIsValid(): void
    {
        self::bootKernel();
        $container = static::getContainer();

        $race = $this->getEntity();

        $errors = $container->get('validator')->validate($race);
        $this->assertCount(0, $errors);
    }
}
 