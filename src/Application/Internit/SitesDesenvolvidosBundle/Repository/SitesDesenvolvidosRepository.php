<?php

namespace App\Application\Internit\SitesDesenvolvidosBundle\Repository;

use App\Application\Internit\SitesDesenvolvidosBundle\Entity\SitesDesenvolvidos;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<SitesDesenvolvidos>
 *
 * @method SitesDesenvolvidos|null find($id, $lockMode = null, $lockVersion = null)
 * @method SitesDesenvolvidos|null findOneBy(array $criteria, array $orderBy = null)
 * @method SitesDesenvolvidos[]    findAll()
 * @method SitesDesenvolvidos[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SitesDesenvolvidosRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SitesDesenvolvidos::class);
    }


}