<?php

namespace App\Tests;

use App\Entity\Race;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class RaceTest extends KernelTestCase
{
    protected static function getKernelClass()
    {
        // Retournez le nom de la classe de noyau (Kernel) de votre application Symfony
        return \App\Kernel::class;
    }

    public function testEntityIsValid(): void
    {
        self::bootKernel();
        $container = static::getContainer();

        $race = new Race();
        $race->setName('Race #1');
        $race->setDescription('Description #1');

        $errors = $container->get('validator')->validate($race);
        $this->assertCount(0, $errors);
    }
}
