<?php

namespace App\Test\Controller;

use App\Entity\Item;
use App\Repository\ItemRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ItemControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private ItemRepository $repository;
    private string $path = '/item/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->repository = (static::getContainer()->get('doctrine'))->getRepository(Item::class);

        foreach ($this->repository->findAll() as $object) {
            $this->repository->remove($object, true);
        }
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Item index');

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
            'item[name]' => 'Testing',
            'item[picture]' => 'Testing',
            'item[health]' => 'Testing',
            'item[strength]' => 'Testing',
            'item[intelligence]' => 'Testing',
            'item[dexterity]' => 'Testing',
            'item[defense]' => 'Testing',
            'item[karma]' => 'Testing',
            'item[xp]' => 'Testing',
            'item[heroes]' => 'Testing',
            'item[npcs]' => 'Testing',
        ]);

        self::assertResponseRedirects('/item/');

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new Item();
        $fixture->setName('My Title');
        $fixture->setPicture('My Title');
        $fixture->setHealth('My Title');
        $fixture->setStrength('My Title');
        $fixture->setIntelligence('My Title');
        $fixture->setDexterity('My Title');
        $fixture->setDefense('My Title');
        $fixture->setKarma('My Title');
        $fixture->setXp('My Title');
        $fixture->setHeroes('My Title');
        $fixture->setNpcs('My Title');

        $this->repository->add($fixture, true);

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Item');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new Item();
        $fixture->setName('My Title');
        $fixture->setPicture('My Title');
        $fixture->setHealth('My Title');
        $fixture->setStrength('My Title');
        $fixture->setIntelligence('My Title');
        $fixture->setDexterity('My Title');
        $fixture->setDefense('My Title');
        $fixture->setKarma('My Title');
        $fixture->setXp('My Title');
        $fixture->setHeroes('My Title');
        $fixture->setNpcs('My Title');

        $this->repository->add($fixture, true);

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'item[name]' => 'Something New',
            'item[picture]' => 'Something New',
            'item[health]' => 'Something New',
            'item[strength]' => 'Something New',
            'item[intelligence]' => 'Something New',
            'item[dexterity]' => 'Something New',
            'item[defense]' => 'Something New',
            'item[karma]' => 'Something New',
            'item[xp]' => 'Something New',
            'item[heroes]' => 'Something New',
            'item[npcs]' => 'Something New',
        ]);

        self::assertResponseRedirects('/item/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getName());
        self::assertSame('Something New', $fixture[0]->getPicture());
        self::assertSame('Something New', $fixture[0]->getHealth());
        self::assertSame('Something New', $fixture[0]->getStrength());
        self::assertSame('Something New', $fixture[0]->getIntelligence());
        self::assertSame('Something New', $fixture[0]->getDexterity());
        self::assertSame('Something New', $fixture[0]->getDefense());
        self::assertSame('Something New', $fixture[0]->getKarma());
        self::assertSame('Something New', $fixture[0]->getXp());
        self::assertSame('Something New', $fixture[0]->getHeroes());
        self::assertSame('Something New', $fixture[0]->getNpcs());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();

        $originalNumObjectsInRepository = count($this->repository->findAll());

        $fixture = new Item();
        $fixture->setName('My Title');
        $fixture->setPicture('My Title');
        $fixture->setHealth('My Title');
        $fixture->setStrength('My Title');
        $fixture->setIntelligence('My Title');
        $fixture->setDexterity('My Title');
        $fixture->setDefense('My Title');
        $fixture->setKarma('My Title');
        $fixture->setXp('My Title');
        $fixture->setHeroes('My Title');
        $fixture->setNpcs('My Title');

        $this->repository->add($fixture, true);

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertSame($originalNumObjectsInRepository, count($this->repository->findAll()));
        self::assertResponseRedirects('/item/');
    }
}
