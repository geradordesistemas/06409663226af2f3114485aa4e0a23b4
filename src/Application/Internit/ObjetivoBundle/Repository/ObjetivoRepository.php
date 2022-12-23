<?php

namespace App\Application\Internit\ObjetivoBundle\Repository;

use App\Application\Internit\ObjetivoBundle\Entity\Objetivo;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Objetivo>
 *
 * @method Objetivo|null find($id, $lockMode = null, $lockVersion = null)
 * @method Objetivo|null findOneBy(array $criteria, array $orderBy = null)
 * @method Objetivo[]    findAll()
 * @method Objetivo[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ObjetivoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Objetivo::class);
    }


}