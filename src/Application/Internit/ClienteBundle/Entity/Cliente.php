<?php

namespace App\Application\Internit\ClienteBundle\Entity;

use App\Application\Internit\ClienteBundle\Repository\ClienteRepository;
use App\Application\Internit\SetorAtuacaoBundle\Entity\SetorAtuacao;
use App\Application\Internit\ProjetoBundle\Entity\Projeto;

use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use App\Entity\SonataMediaGallery;
use App\Entity\SonataMediaMedia;
use Doctrine\ORM\Mapping as ORM;
use DateTime;

/** Info:  */
#[ORM\Table(name: 'cliente')]
#[ORM\Entity(repositoryClass: ClienteRepository::class)]
#[UniqueEntity('id')]
class Cliente
{

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'id', type: 'integer', unique: true, nullable: false)]
    private ?int $id = null;

    #[Assert\NotNull]
    #[Assert\NotBlank]
    #[ORM\Column(name: 'nome', type: 'string', unique: false, nullable: false)]
    private string $nome;

    #[ORM\Column(name: 'descricao', type: 'text', unique: false, nullable: true)]
    private ?string $descricao = null;

    #[ORM\ManyToOne(targetEntity: SonataMediaMedia::class, cascade: ['persist'])]
    private mixed $logo;

    #[ORM\JoinTable(name: 'setor_atuacao_cliente')]
    #[ORM\JoinColumn(name: 'cliente_id', referencedColumnName: 'id')] // , onDelete: 'SET NULL'
    #[ORM\InverseJoinColumn(name: 'setor_atuacao_id', referencedColumnName: 'id')]
    #[ORM\ManyToMany(targetEntity: SetorAtuacao::class, inversedBy: 'clientes')]
    private Collection $setorAtuacao;

    #[ORM\OneToMany(mappedBy: 'cliente', targetEntity: Projeto::class)]
    private Collection $projetos;


    public function __construct()
    {
        $this->setorAtuacao = new ArrayCollection();
        $this->projetos = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }


    public function getNome(): string
    {
        return $this->nome;
    }

    public function setNome(string $nome): void
    {
        $this->nome = $nome;
    }

    public function getDescricao(): ?string
    {
        return $this->descricao;
    }

    public function setDescricao(?string $descricao): void
    {
        $this->descricao = $descricao;
    }

    public function getLogo(): mixed
    {
        return $this->logo;
    }

    public function setLogo(mixed $logo): void
    {
        $this->logo = $logo;
    }


    public function getSetorAtuacao(): Collection
    {
        return $this->setorAtuacao;
    }

    public function setSetorAtuacao(Collection $setorAtuacao): void
    {
        $this->setorAtuacao = $setorAtuacao;
    }


    public function getProjetos(): Collection
    {
        return $this->projetos;
    }

    public function setProjetos(Collection $projetos): void
    {
        $this->projetos = $projetos;
    }



}