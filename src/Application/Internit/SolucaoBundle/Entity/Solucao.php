<?php

namespace App\Application\Internit\SolucaoBundle\Entity;

use App\Application\Internit\SolucaoBundle\Repository\SolucaoRepository;
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
#[ORM\Table(name: 'solucao')]
#[ORM\Entity(repositoryClass: SolucaoRepository::class)]
#[UniqueEntity('id')]
class Solucao
{

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'id', type: 'integer', unique: true, nullable: false)]
    private ?int $id = null;

    #[Assert\NotNull]
    #[Assert\NotBlank]
    #[ORM\Column(name: 'nome', type: 'string', unique: false, nullable: false)]
    private string $nome;

    #[ORM\Column(name: 'titulo', type: 'string', unique: false, nullable: true)]
    private ?string $titulo = null;

    #[ORM\Column(name: 'descricao', type: 'text', unique: false, nullable: true)]
    private ?string $descricao = null;

    #[ORM\OneToMany(mappedBy: 'solucao', targetEntity: Projeto::class)]
    private Collection $projetos;


    public function __construct()
    {
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

    public function getTitulo(): ?string
    {
        return $this->titulo;
    }

    public function setTitulo(?string $titulo): void
    {
        $this->titulo = $titulo;
    }

    public function getDescricao(): ?string
    {
        return $this->descricao;
    }

    public function setDescricao(?string $descricao): void
    {
        $this->descricao = $descricao;
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