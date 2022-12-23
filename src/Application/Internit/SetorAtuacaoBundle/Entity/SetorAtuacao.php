<?php

namespace App\Application\Internit\SetorAtuacaoBundle\Entity;

use App\Application\Internit\SetorAtuacaoBundle\Repository\SetorAtuacaoRepository;
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
#[ORM\Table(name: 'setor_atuacao')]
#[ORM\Entity(repositoryClass: SetorAtuacaoRepository::class)]
#[UniqueEntity('id')]
class SetorAtuacao
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

    #[ORM\ManyToMany(targetEntity: Cliente::class, mappedBy: 'setorAtuacao')]
    private Collection $clientes;


    public function __construct()
    {
        $this->clientes = new ArrayCollection();
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

    public function getClientes(): Collection
    {
        return $this->clientes;
    }

    public function setClientes(Collection $clientes): void
    {
        $this->clientes = $clientes;
    }



}