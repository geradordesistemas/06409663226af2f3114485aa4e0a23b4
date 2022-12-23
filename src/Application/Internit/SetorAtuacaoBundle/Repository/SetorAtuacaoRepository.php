<?php

namespace App\Application\Internit\SetorAtuacaoBundle\Repository;

use App\Application\Internit\SetorAtuacaoBundle\Entity\SetorAtuacao;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<SetorAtuacao>
 *
 * @method SetorAtuacao|null find($id, $lockMode = null, $lockVersion = null)
 * @method SetorAtuacao|null findOneBy(array $criteria, array $orderBy = null)
 * @method SetorAtuacao[]    findAll()
 * @method SetorAtuacao[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SetorAtuacaoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SetorAtuacao::class);
    }


}