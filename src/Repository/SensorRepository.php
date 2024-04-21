<?php

namespace App\Repository;

use App\Entity\Sensor;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Sensor>
 *
 * @method Sensor|null find($id, $lockMode = null, $lockVersion = null)
 * @method Sensor|null findOneBy(array $criteria, array $orderBy = null)
 * @method Sensor[]    findAll()
 * @method Sensor[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SensorRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Sensor::class);
    }

    public function findAllByModuleId($moduleId)
    {
        // Get all sensors for the current module
        $entityManager = $this->getEntityManager();
        $query = $entityManager->createQuery(
            'SELECT s
            FROM App\Entity\Sensor s
            WHERE s.modules = :moduleId'
        )->setParameter('moduleId', $moduleId);

        return $query->getResult();
    }
}
