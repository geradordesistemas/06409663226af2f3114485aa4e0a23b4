<?php

namespace App\Application\Internit\ContatoBundle\Entity;

use App\Application\Internit\ContatoBundle\Repository\ContatoRepository;
use App\Application\Internit\DepartamentoBundle\Entity\Departamento;

use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use App\Entity\SonataMediaGallery;
use App\Entity\SonataMediaMedia;
use Doctrine\ORM\Mapping as ORM;
use DateTime;

/** Info:  */
#[ORM\Table(name: 'contato')]
#[ORM\Entity(repositoryClass: ContatoRepository::class)]
#[UniqueEntity('id')]
class Contato
{

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'id', type: 'integer', unique: true, nullable: false)]
    private ?int $id = null;

    #[Assert\NotNull]
    #[Assert\NotBlank]
    #[ORM\Column(name: 'nome', type: 'string', unique: false, nullable: false)]
    private string $nome;

    #[Assert\NotNull]
    #[Assert\NotBlank]
    #[ORM\Column(name: 'email', type: 'string', unique: false, nullable: false)]
    private string $email;

    #[Assert\NotNull]
    #[Assert\NotBlank]
    #[ORM\Column(name: 'telefone', type: 'string', unique: false, nullable: false)]
    private string $telefone;

    #[Assert\NotNull]
    #[Assert\NotBlank]
    #[ORM\Column(name: 'mensagem', type: 'text', unique: false, nullable: false)]
    private string $mensagem;

    #[Assert\NotNull]
    #[Assert\NotBlank]
    #[ORM\Column(name: 'comoConheceu', type: 'text', unique: false, nullable: false)]
    private string $comoConheceu;

    #[ORM\Column(name: 'receberInformativos', type: 'boolean', unique: false, nullable: true)]
    private ?bool $receberInformativos = null;

    #[ORM\Column(name: 'politicaPrivacidade', type: 'boolean', unique: false, nullable: true)]
    private ?bool $politicaPrivacidade = null;

    #[ORM\ManyToOne(targetEntity: Departamento::class)]
    #[ORM\JoinColumn(name: 'departamento_id', referencedColumnName: 'id', onDelete: 'SET NULL')]
    private Departamento|null $departamento = null;


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

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getTelefone(): string
    {
        return $this->telefone;
    }

    public function setTelefone(string $telefone): void
    {
        $this->telefone = $telefone;
    }

    public function getMensagem(): string
    {
        return $this->mensagem;
    }

    public function setMensagem(string $mensagem): void
    {
        $this->mensagem = $mensagem;
    }

    public function getComoconheceu(): string
    {
        return $this->comoConheceu;
    }

    public function setComoconheceu(string $comoConheceu): void
    {
        $this->comoConheceu = $comoConheceu;
    }

    public function getReceberinformativos(): ?bool
    {
        return $this->receberInformativos;
    }

    public function setReceberinformativos(?bool $receberInformativos): void
    {
        $this->receberInformativos = $receberInformativos;
    }

    public function getPoliticaprivacidade(): ?bool
    {
        return $this->politicaPrivacidade;
    }

    public function setPoliticaprivacidade(?bool $politicaPrivacidade): void
    {
        $this->politicaPrivacidade = $politicaPrivacidade;
    }

    public function getDepartamento(): ?Departamento
    {
        return $this->departamento;
    }

    public function setDepartamento(?Departamento $departamento): void
    {
        $this->departamento = $departamento;
    }



}