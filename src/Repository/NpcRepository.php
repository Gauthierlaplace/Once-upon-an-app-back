<?php

namespace App\Repository;

use App\Entity\Npc;
use App\Model\SearchData;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;


/**
 * @extends ServiceEntityRepository<Npc>
 *
 * @method Npc|null find($id, $lockMode = null, $lockVersion = null)
 * @method Npc|null findOneBy(array $criteria, array $orderBy = null)
 * @method Npc[]    findAll()
 * @method Npc[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NpcRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Npc::class);
    }

    public function add(Npc $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Npc $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findByRace($id)
    {
        return $this->createQueryBuilder('npc')
            ->where('npc.race = :race_id')
            ->setParameter('race_id', $id)
            ->getQuery()
            ->getResult();
    }

    /**
     * Find npcs with Search Bar
     *
     * @param SearchData $searchData
     * @return void
     */
    public function findBySearch(SearchData $searchData)
    {
        $data = $this->createQueryBuilder('p') 
        ->where('p.name LIKE :name')
        ->setParameter('name', '%' . $searchData->q . '%');

        if (!empty($searchData->q)) {
            $data = $data
            ->andWhere('p.name LIKE :q')
            ->setParameter('q', "%{$searchData->q}%");
        }

        $data = $data->getQuery()
        ->getResult();

        return $data;
    }

    //    /**
    //     * @return Npc[] Returns an array of Npc objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('n')
    //            ->andWhere('n.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('n.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Npc
    //    {
    //        return $this->createQueryBuilder('n')
    //            ->andWhere('n.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
