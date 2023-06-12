<?php

namespace App\Test\Controller;

use App\Entity\Npc;
use App\Repository\NpcRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class NpcControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private NpcRepository $repository;
    private string $path = '/npc/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->repository = (static::getContainer()->get('doctrine'))->getRepository(Npc::class);

        foreach ($this->repository->findAll() as $object) {
            $this->repository->remove($object, true);
        }
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Npc index');

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
            'npc[name]' => 'Testing',
            'npc[description]' => 'Testing',
            'npc[health]' => 'Testing',
            'npc[strength]' => 'Testing',
            'npc[intelligence]' => 'Testing',
            'npc[dexterity]' => 'Testing',
            'npc[defense]' => 'Testing',
            'npc[karma]' => 'Testing',
            'npc[picture]' => 'Testing',
            'npc[isBoss]' => 'Testing',
            'npc[hostility]' => 'Testing',
            'npc[xpEarned]' => 'Testing',
            'npc[race]' => 'Testing',
            'npc[item]' => 'Testing',
            'npc[events]' => 'Testing',
        ]);

        self::assertResponseRedirects('/npc/');

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new Npc();
        $fixture->setName('My Title');
        $fixture->setDescription('My Title');
        $fixture->setHealth('My Title');
        $fixture->setStrength('My Title');
        $fixture->setIntelligence('My Title');
        $fixture->setDexterity('My Title');
        $fixture->setDefense('My Title');
        $fixture->setKarma('My Title');
        $fixture->setPicture('My Title');
        $fixture->setIsBoss('My Title');
        $fixture->setHostility('My Title');
        $fixture->setXpEarned('My Title');
        $fixture->setRace('My Title');
        $fixture->setItem('My Title');
        $fixture->setEvents('My Title');

        $this->repository->add($fixture, true);

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Npc');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new Npc();
        $fixture->setName('My Title');
        $fixture->setDescription('My Title');
        $fixture->setHealth('My Title');
        $fixture->setStrength('My Title');
        $fixture->setIntelligence('My Title');
        $fixture->setDexterity('My Title');
        $fixture->setDefense('My Title');
        $fixture->setKarma('My Title');
        $fixture->setPicture('My Title');
        $fixture->setIsBoss('My Title');
        $fixture->setHostility('My Title');
        $fixture->setXpEarned('My Title');
        $fixture->setRace('My Title');
        $fixture->setItem('My Title');
        $fixture->setEvents('My Title');

        $this->repository->add($fixture, true);

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'npc[name]' => 'Something New',
            'npc[description]' => 'Something New',
            'npc[health]' => 'Something New',
            'npc[strength]' => 'Something New',
            'npc[intelligence]' => 'Something New',
            'npc[dexterity]' => 'Something New',
            'npc[defense]' => 'Something New',
            'npc[karma]' => 'Something New',
            'npc[picture]' => 'Something New',
            'npc[isBoss]' => 'Something New',
            'npc[hostility]' => 'Something New',
            'npc[xpEarned]' => 'Something New',
            'npc[race]' => 'Something New',
            'npc[item]' => 'Something New',
            'npc[events]' => 'Something New',
        ]);

        self::assertResponseRedirects('/npc/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getName());
        self::assertSame('Something New', $fixture[0]->getDescription());
        self::assertSame('Something New', $fixture[0]->getHealth());
        self::assertSame('Something New', $fixture[0]->getStrength());
        self::assertSame('Something New', $fixture[0]->getIntelligence());
        self::assertSame('Something New', $fixture[0]->getDexterity());
        self::assertSame('Something New', $fixture[0]->getDefense());
        self::assertSame('Something New', $fixture[0]->getKarma());
        self::assertSame('Something New', $fixture[0]->getPicture());
        self::assertSame('Something New', $fixture[0]->getIsBoss());
        self::assertSame('Something New', $fixture[0]->getHostility());
        self::assertSame('Something New', $fixture[0]->getXpEarned());
        self::assertSame('Something New', $fixture[0]->getRace());
        self::assertSame('Something New', $fixture[0]->getItem());
        self::assertSame('Something New', $fixture[0]->getEvents());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();

        $originalNumObjectsInRepository = count($this->repository->findAll());

        $fixture = new Npc();
        $fixture->setName('My Title');
        $fixture->setDescription('My Title');
        $fixture->setHealth('My Title');
        $fixture->setStrength('My Title');
        $fixture->setIntelligence('My Title');
        $fixture->setDexterity('My Title');
        $fixture->setDefense('My Title');
        $fixture->setKarma('My Title');
        $fixture->setPicture('My Title');
        $fixture->setIsBoss('My Title');
        $fixture->setHostility('My Title');
        $fixture->setXpEarned('My Title');
        $fixture->setRace('My Title');
        $fixture->setItem('My Title');
        $fixture->setEvents('My Title');

        $this->repository->add($fixture, true);

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertSame($originalNumObjectsInRepository, count($this->repository->findAll()));
        self::assertResponseRedirects('/npc/');
    }
}
