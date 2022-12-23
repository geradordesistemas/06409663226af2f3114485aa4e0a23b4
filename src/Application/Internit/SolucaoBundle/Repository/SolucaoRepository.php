<?php

namespace App\Application\Internit\SolucaoBundle\Repository;

use App\Application\Internit\SolucaoBundle\Entity\Solucao;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Solucao>
 *
 * @method Solucao|null find($id, $lockMode = null, $lockVersion = null)
 * @method Solucao|null findOneBy(array $criteria, array $orderBy = null)
 * @method Solucao[]    findAll()
 * @method Solucao[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SolucaoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Solucao::class);
    }


}