<?php

namespace App\Application\Internit\CurriculoBundle\Repository;

use App\Application\Internit\CurriculoBundle\Entity\Curriculo;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Curriculo>
 *
 * @method Curriculo|null find($id, $lockMode = null, $lockVersion = null)
 * @method Curriculo|null findOneBy(array $criteria, array $orderBy = null)
 * @method Curriculo[]    findAll()
 * @method Curriculo[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CurriculoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Curriculo::class);
    }


}