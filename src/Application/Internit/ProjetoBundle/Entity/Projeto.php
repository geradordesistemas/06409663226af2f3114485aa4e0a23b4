<?php

namespace App\Application\Internit\ProjetoBundle\Entity;

use App\Application\Internit\ProjetoBundle\Repository\ProjetoRepository;
use App\Application\Internit\SolucaoBundle\Entity\Solucao;
use App\Application\Internit\ClienteBundle\Entity\Cliente;

use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use App\Entity\SonataMediaGallery;
use App\Entity\SonataMediaMedia;
use Doctrine\ORM\Mapping as ORM;
use DateTime;

/** Info:  */
#[ORM\Table(name: 'projeto')]
#[ORM\Entity(repositoryClass: ProjetoRepository::class)]
#[UniqueEntity('id')]
class Projeto
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

    #[ORM\Column(name: 'url', type: 'string', unique: false, nullable: true)]
    private ?string $url = null;

    #[ORM\ManyToOne(targetEntity: SonataMediaMedia::class, cascade: ['persist'])]
    private mixed $logo;

    #[ORM\ManyToOne(targetEntity: Solucao::class, inversedBy: 'projetos')]
    #[ORM\JoinColumn(name: 'solucao_id', referencedColumnName: 'id', onDelete: 'SET NULL')]
    private Solucao|null $solucao = null;

    #[ORM\ManyToOne(targetEntity: Cliente::class, inversedBy: 'projetos')]
    #[ORM\JoinColumn(name: 'cliente_id', referencedColumnName: 'id', onDelete: 'SET NULL')]
    private Cliente|null $cliente = null;


    public function __construct()
    {
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

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(?string $url): void
    {
        $this->url = $url;
    }

    public function getLogo(): mixed
    {
        return $this->logo;
    }

    public function setLogo(mixed $logo): void
    {
        $this->logo = $logo;
    }


    public function getSolucao(): ?Solucao
    {
        return $this->solucao;
    }

    public function setSolucao(?Solucao $solucao): void
    {
        $this->solucao = $solucao;
    }


    public function getCliente(): ?Cliente
    {
        return $this->cliente;
    }

    public function setCliente(?Cliente $cliente): void
    {
        $this->cliente = $cliente;
    }



}