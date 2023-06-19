<?php

namespace App\Test\Controller;

use App\Entity\HeroClass;
use App\Repository\HeroClassRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class HeroClassControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private HeroClassRepository $repository;
    private string $path = '/hero/class/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->repository = (static::getContainer()->get('doctrine'))->getRepository(HeroClass::class);

        foreach ($this->repository->findAll() as $object) {
            $this->repository->remove($object, true);
        }
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('HeroClass index');

        // Use the $crawler to perform additional assertions e.g.
        // self::assertSame('Some text on the page', $crawler->filter('.p')->first());
    }

    public function testNew(): void
    {
        $originalNumObjectsInRepository = count($this->repository->findAll());

        $this->markTestIncomplete();
        $this->client->request('GET', sprintf('%snew', $this->path));

        self::assertResponseStatusCodeSame(200);

        $this->client->submitForm('Save', [
            'hero_class[name]' => 'Testing',
            'hero_class[maxHealth]' => 'Testing',
            'hero_class[health]' => 'Testing',
            'hero_class[strength]' => 'Testing',
            'hero_class[intelligence]' => 'Testing',
            'hero_class[dexterity]' => 'Testing',
            'hero_class[defense]' => 'Testing',
        ]);

        self::assertResponseRedirects('/hero/class/');

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new HeroClass();
        $fixture->setName('My Title');
        $fixture->setMaxHealth('My Title');
        $fixture->setHealth('My Title');
        $fixture->setStrength('My Title');
        $fixture->setIntelligence('My Title');
        $fixture->setDexterity('My Title');
        $fixture->setDefense('My Title');

        $this->repository->add($fixture, true);

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('HeroClass');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new HeroClass();
        $fixture->setName('My Title');
        $fixture->setMaxHealth('My Title');
        $fixture->setHealth('My Title');
        $fixture->setStrength('My Title');
        $fixture->setIntelligence('My Title');
        $fixture->setDexterity('My Title');
        $fixture->setDefense('My Title');

        $this->repository->add($fixture, true);

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'hero_class[name]' => 'Something New',
            'hero_class[maxHealth]' => 'Something New',
            'hero_class[health]' => 'Something New',
            'hero_class[strength]' => 'Something New',
            'hero_class[intelligence]' => 'Something New',
            'hero_class[dexterity]' => 'Something New',
            'hero_class[defense]' => 'Something New',
        ]);

        self::assertResponseRedirects('/hero/class/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getName());
        self::assertSame('Something New', $fixture[0]->getMaxHealth());
        self::assertSame('Something New', $fixture[0]->getHealth());
        self::assertSame('Something New', $fixture[0]->getStrength());
        self::assertSame('Something New', $fixture[0]->getIntelligence());
        self::assertSame('Something New', $fixture[0]->getDexterity());
        self::assertSame('Something New', $fixture[0]->getDefense());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();

        $originalNumObjectsInRepository = count($this->repository->findAll());

        $fixture = new HeroClass();
        $fixture->setName('My Title');
        $fixture->setMaxHealth('My Title');
        $fixture->setHealth('My Title');
        $fixture->setStrength('My Title');
        $fixture->setIntelligence('My Title');
        $fixture->setDexterity('My Title');
        $fixture->setDefense('My Title');

        $this->repository->add($fixture, true);

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertSame($originalNumObjectsInRepository, count($this->repository->findAll()));
        self::assertResponseRedirects('/hero/class/');
    }
}
