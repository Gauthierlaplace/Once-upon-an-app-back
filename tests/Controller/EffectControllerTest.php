<?php

namespace App\Test\Controller;

use App\Entity\Effect;
use App\Repository\EffectRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class EffectControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private EffectRepository $repository;
    private string $path = '/effect/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->repository = (static::getContainer()->get('doctrine'))->getRepository(Effect::class);

        foreach ($this->repository->findAll() as $object) {
            $this->repository->remove($object, true);
        }
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Effect index');

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
            'effect[name]' => 'Testing',
            'effect[description]' => 'Testing',
            'effect[health]' => 'Testing',
            'effect[strength]' => 'Testing',
            'effect[intelligence]' => 'Testing',
            'effect[dexteriry]' => 'Testing',
            'effect[defense]' => 'Testing',
            'effect[karma]' => 'Testing',
            'effect[xp]' => 'Testing',
            'effect[answers]' => 'Testing',
        ]);

        self::assertResponseRedirects('/effect/');

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new Effect();
        $fixture->setName('My Title');
        $fixture->setDescription('My Title');
        $fixture->setHealth('My Title');
        $fixture->setStrength('My Title');
        $fixture->setIntelligence('My Title');
        $fixture->setDexteriry('My Title');
        $fixture->setDefense('My Title');
        $fixture->setKarma('My Title');
        $fixture->setXp('My Title');
        $fixture->setAnswers('My Title');

        $this->repository->add($fixture, true);

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Effect');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new Effect();
        $fixture->setName('My Title');
        $fixture->setDescription('My Title');
        $fixture->setHealth('My Title');
        $fixture->setStrength('My Title');
        $fixture->setIntelligence('My Title');
        $fixture->setDexteriry('My Title');
        $fixture->setDefense('My Title');
        $fixture->setKarma('My Title');
        $fixture->setXp('My Title');
        $fixture->setAnswers('My Title');

        $this->repository->add($fixture, true);

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'effect[name]' => 'Something New',
            'effect[description]' => 'Something New',
            'effect[health]' => 'Something New',
            'effect[strength]' => 'Something New',
            'effect[intelligence]' => 'Something New',
            'effect[dexteriry]' => 'Something New',
            'effect[defense]' => 'Something New',
            'effect[karma]' => 'Something New',
            'effect[xp]' => 'Something New',
            'effect[answers]' => 'Something New',
        ]);

        self::assertResponseRedirects('/effect/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getName());
        self::assertSame('Something New', $fixture[0]->getDescription());
        self::assertSame('Something New', $fixture[0]->getHealth());
        self::assertSame('Something New', $fixture[0]->getStrength());
        self::assertSame('Something New', $fixture[0]->getIntelligence());
        self::assertSame('Something New', $fixture[0]->getDexteriry());
        self::assertSame('Something New', $fixture[0]->getDefense());
        self::assertSame('Something New', $fixture[0]->getKarma());
        self::assertSame('Something New', $fixture[0]->getXp());
        self::assertSame('Something New', $fixture[0]->getAnswers());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();

        $originalNumObjectsInRepository = count($this->repository->findAll());

        $fixture = new Effect();
        $fixture->setName('My Title');
        $fixture->setDescription('My Title');
        $fixture->setHealth('My Title');
        $fixture->setStrength('My Title');
        $fixture->setIntelligence('My Title');
        $fixture->setDexteriry('My Title');
        $fixture->setDefense('My Title');
        $fixture->setKarma('My Title');
        $fixture->setXp('My Title');
        $fixture->setAnswers('My Title');

        $this->repository->add($fixture, true);

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertSame($originalNumObjectsInRepository, count($this->repository->findAll()));
        self::assertResponseRedirects('/effect/');
    }
}
