<?php

namespace App\Application\Internit\ProjetoBundle\Repository;

use App\Application\Internit\ProjetoBundle\Entity\Projeto;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Projeto>
 *
 * @method Projeto|null find($id, $lockMode = null, $lockVersion = null)
 * @method Projeto|null findOneBy(array $criteria, array $orderBy = null)
 * @method Projeto[]    findAll()
 * @method Projeto[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProjetoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Projeto::class);
    }


}