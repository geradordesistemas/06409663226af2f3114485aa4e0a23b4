<?php

namespace App\Application\Internit\EnderecoBundle\Repository;

use App\Application\Internit\EnderecoBundle\Entity\Endereco;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Endereco>
 *
 * @method Endereco|null find($id, $lockMode = null, $lockVersion = null)
 * @method Endereco|null findOneBy(array $criteria, array $orderBy = null)
 * @method Endereco[]    findAll()
 * @method Endereco[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EnderecoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Endereco::class);
    }


}