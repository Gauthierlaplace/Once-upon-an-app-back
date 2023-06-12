<?php

namespace App\Test\Controller;

use App\Entity\Hero;
use App\Repository\HeroRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class HeroControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private HeroRepository $repository;
    private string $path = '/hero/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->repository = (static::getContainer()->get('doctrine'))->getRepository(Hero::class);

        foreach ($this->repository->findAll() as $object) {
            $this->repository->remove($object, true);
        }
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Hero index');

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
            'hero[name]' => 'Testing',
            'hero[maxHealth]' => 'Testing',
            'hero[health]' => 'Testing',
            'hero[strength]' => 'Testing',
            'hero[intelligence]' => 'Testing',
            'hero[dexterity]' => 'Testing',
            'hero[defense]' => 'Testing',
            'hero[karma]' => 'Testing',
            'hero[xp]' => 'Testing',
            'hero[picture]' => 'Testing',
            'hero[progress]' => 'Testing',
            'hero[heroClass]' => 'Testing',
            'hero[user]' => 'Testing',
            'hero[item]' => 'Testing',
            'hero[event]' => 'Testing',
        ]);

        self::assertResponseRedirects('/hero/');

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new Hero();
        $fixture->setName('My Title');
        $fixture->setMaxHealth('My Title');
        $fixture->setHealth('My Title');
        $fixture->setStrength('My Title');
        $fixture->setIntelligence('My Title');
        $fixture->setDexterity('My Title');
        $fixture->setDefense('My Title');
        $fixture->setKarma('My Title');
        $fixture->setXp('My Title');
        $fixture->setPicture('My Title');
        $fixture->setProgress('My Title');
        $fixture->setHeroClass('My Title');
        $fixture->setUser('My Title');
        $fixture->setItem('My Title');
        $fixture->setEvent('My Title');

        $this->repository->add($fixture, true);

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Hero');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new Hero();
        $fixture->setName('My Title');
        $fixture->setMaxHealth('My Title');
        $fixture->setHealth('My Title');
        $fixture->setStrength('My Title');
        $fixture->setIntelligence('My Title');
        $fixture->setDexterity('My Title');
        $fixture->setDefense('My Title');
        $fixture->setKarma('My Title');
        $fixture->setXp('My Title');
        $fixture->setPicture('My Title');
        $fixture->setProgress('My Title');
        $fixture->setHeroClass('My Title');
        $fixture->setUser('My Title');
        $fixture->setItem('My Title');
        $fixture->setEvent('My Title');

        $this->repository->add($fixture, true);

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'hero[name]' => 'Something New',
            'hero[maxHealth]' => 'Something New',
            'hero[health]' => 'Something New',
            'hero[strength]' => 'Something New',
            'hero[intelligence]' => 'Something New',
            'hero[dexterity]' => 'Something New',
            'hero[defense]' => 'Something New',
            'hero[karma]' => 'Something New',
            'hero[xp]' => 'Something New',
            'hero[picture]' => 'Something New',
            'hero[progress]' => 'Something New',
            'hero[heroClass]' => 'Something New',
            'hero[user]' => 'Something New',
            'hero[item]' => 'Something New',
            'hero[event]' => 'Something New',
        ]);

        self::assertResponseRedirects('/hero/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getName());
        self::assertSame('Something New', $fixture[0]->getMaxHealth());
        self::assertSame('Something New', $fixture[0]->getHealth());
        self::assertSame('Something New', $fixture[0]->getStrength());
        self::assertSame('Something New', $fixture[0]->getIntelligence());
        self::assertSame('Something New', $fixture[0]->getDexterity());
        self::assertSame('Something New', $fixture[0]->getDefense());
        self::assertSame('Something New', $fixture[0]->getKarma());
        self::assertSame('Something New', $fixture[0]->getXp());
        self::assertSame('Something New', $fixture[0]->getPicture());
        self::assertSame('Something New', $fixture[0]->getProgress());
        self::assertSame('Something New', $fixture[0]->getHeroClass());
        self::assertSame('Something New', $fixture[0]->getUser());
        self::assertSame('Something New', $fixture[0]->getItem());
        self::assertSame('Something New', $fixture[0]->getEvent());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();

        $originalNumObjectsInRepository = count($this->repository->findAll());

        $fixture = new Hero();
        $fixture->setName('My Title');
        $fixture->setMaxHealth('My Title');
        $fixture->setHealth('My Title');
        $fixture->setStrength('My Title');
        $fixture->setIntelligence('My Title');
        $fixture->setDexterity('My Title');
        $fixture->setDefense('My Title');
        $fixture->setKarma('My Title');
        $fixture->setXp('My Title');
        $fixture->setPicture('My Title');
        $fixture->setProgress('My Title');
        $fixture->setHeroClass('My Title');
        $fixture->setUser('My Title');
        $fixture->setItem('My Title');
        $fixture->setEvent('My Title');

        $this->repository->add($fixture, true);

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertSame($originalNumObjectsInRepository, count($this->repository->findAll()));
        self::assertResponseRedirects('/hero/');
    }
}
