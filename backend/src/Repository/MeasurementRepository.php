<?php

namespace App\Repository;

use App\Entity\Measurement;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Measurement>
 *
 * @method Measurement|null find($id, $lockMode = null, $lockVersion = null)
 * @method Measurement|null findOneBy(array $criteria, array $orderBy = null)
 * @method Measurement[]    findAll()
 * @method Measurement[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MeasurementRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Measurement::class);
    }

    public function findAllByModuleId($moduleId)
    {
        // Get all measurements for the current module
        $entityManager = $this->getEntityManager();
        $query = $entityManager->createQuery(
            'SELECT m
            FROM App\Entity\Measurement m
            WHERE m.module = :moduleId'
        )->setParameter('moduleId', $moduleId);

        return $query->getResult();
    }

    public function findLast12hByModuleId($moduleId)
    {
        $date = new \DateTimeImmutable('-12 hours');

        return $this->createQueryBuilder('m')
            ->join('m.Sensor', 's')
            ->join('s.module', 'mod')
            ->where('mod.id = :moduleId')
            ->andWhere('m.createdAt >= :date')
            ->setParameter('moduleId', $moduleId)
            ->setParameter('date', $date)
            ->orderBy('m.createdAt', 'ASC')
            ->getQuery()
            ->getResult();
    }
}
