<?php

namespace App\Application\Internit\ContatoBundle\Repository;

use App\Application\Internit\ContatoBundle\Entity\Contato;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Contato>
 *
 * @method Contato|null find($id, $lockMode = null, $lockVersion = null)
 * @method Contato|null findOneBy(array $criteria, array $orderBy = null)
 * @method Contato[]    findAll()
 * @method Contato[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ContatoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Contato::class);
    }


}