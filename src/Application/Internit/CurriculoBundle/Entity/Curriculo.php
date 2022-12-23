<?php

namespace App\Application\Internit\CurriculoBundle\Entity;

use App\Application\Internit\CurriculoBundle\Repository\CurriculoRepository;
use App\Application\Internit\CargoBundle\Entity\Cargo;
use App\Application\Internit\ObjetivoBundle\Entity\Objetivo;
use App\Application\Internit\SitesDesenvolvidosBundle\Entity\SitesDesenvolvidos;

use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use App\Entity\SonataMediaGallery;
use App\Entity\SonataMediaMedia;
use Doctrine\ORM\Mapping as ORM;
use DateTime;

/** Info:  */
#[ORM\Table(name: 'curriculo')]
#[ORM\Entity(repositoryClass: CurriculoRepository::class)]
#[UniqueEntity('id')]
class Curriculo
{

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'id', type: 'integer', unique: true, nullable: false)]
    private ?int $id = null;

    #[Assert\NotNull]
    #[Assert\NotBlank]
    #[ORM\Column(name: 'nomeCompleto', type: 'string', unique: false, nullable: false)]
    private string $nomeCompleto;

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
    #[Assert\Date]
    #[ORM\Column(name: 'dataNascimento', type: 'date', unique: false, nullable: false)]
    private DateTime $dataNascimento;

    #[Assert\NotNull]
    #[Assert\NotBlank]
    #[ORM\Column(name: 'estado', type: 'string', unique: false, nullable: false)]
    private string $estado;

    #[Assert\NotNull]
    #[Assert\NotBlank]
    #[ORM\Column(name: 'cidade', type: 'string', unique: false, nullable: false)]
    private string $cidade;

    #[Assert\NotNull]
    #[Assert\NotBlank]
    #[ORM\Column(name: 'estadoCivil', type: 'string', unique: false, nullable: false)]
    private string $estadoCivil;

    #[Assert\NotNull]
    #[Assert\NotBlank]
    #[ORM\Column(name: 'bairro', type: 'string', unique: false, nullable: false)]
    private string $bairro;

    #[ORM\Column(name: 'perfilFacebookInstagram', type: 'string', unique: false, nullable: true)]
    private ?string $perfilFacebookInstagram = null;

    #[ORM\Column(name: 'perfilLinkedin', type: 'string', unique: false, nullable: true)]
    private ?string $perfilLinkedin = null;

    #[Assert\NotNull]
    #[Assert\NotBlank]
    #[ORM\Column(name: 'comoConheceu', type: 'text', unique: false, nullable: false)]
    private string $comoConheceu;

    #[Assert\NotNull]
    #[Assert\NotBlank]
    #[ORM\Column(name: 'salarioAceitavel', type: 'string', unique: false, nullable: false)]
    private string $salarioAceitavel;

    #[Assert\NotNull]
    #[Assert\NotBlank]
    #[ORM\Column(name: 'salarioPretentido', type: 'string', unique: false, nullable: false)]
    private string $salarioPretentido;

    #[Assert\NotNull]
    #[Assert\NotBlank]
    #[ORM\Column(name: 'tempoExperiencia1', type: 'string', unique: false, nullable: false)]
    private string $tempoExperiencia1;

    #[Assert\NotNull]
    #[Assert\NotBlank]
    #[ORM\Column(name: 'tempoExperiencia2', type: 'string', unique: false, nullable: false)]
    private string $tempoExperiencia2;

    #[Assert\NotNull]
    #[Assert\NotBlank]
    #[ORM\Column(name: 'mensagem', type: 'text', unique: false, nullable: false)]
    private string $mensagem;

    #[ORM\Column(name: 'politicaPrivacidade', type: 'boolean', unique: false, nullable: true)]
    private ?bool $politicaPrivacidade = null;

    #[ORM\ManyToOne(targetEntity: Cargo::class)]
    #[ORM\JoinColumn(name: 'cargo1_id', referencedColumnName: 'id', onDelete: 'SET NULL')]
    private Cargo|null $cargo1 = null;

    #[ORM\ManyToOne(targetEntity: Cargo::class)]
    #[ORM\JoinColumn(name: 'cargo2_id', referencedColumnName: 'id', onDelete: 'SET NULL')]
    private Cargo|null $cargo2 = null;

    #[ORM\ManyToOne(targetEntity: SonataMediaMedia::class, cascade: ['persist'])]
    private mixed $curriculo;

    #[ORM\JoinTable(name: 'objetivo_curriculo')]
    #[ORM\JoinColumn(name: 'curriculo_id', referencedColumnName: 'id')] // , onDelete: 'SET NULL'
    #[ORM\InverseJoinColumn(name: 'objetivo_id', referencedColumnName: 'id')]
    #[ORM\ManyToMany(targetEntity: Objetivo::class)]
    private Collection $objetivos;

    #[ORM\JoinTable(name: 'sites_desenvolvidos_curriculo')]
    #[ORM\JoinColumn(name: 'curriculo_id', referencedColumnName: 'id')] // , onDelete: 'SET NULL'
    #[ORM\InverseJoinColumn(name: 'sites_desenvolvidos_id', referencedColumnName: 'id')]
    #[ORM\ManyToMany(targetEntity: SitesDesenvolvidos::class, inversedBy: 'curriculos')]
    private Collection $sitesDesenvolvidos;


    public function __construct()
    {
        $this->objetivos = new ArrayCollection();
        $this->sitesDesenvolvidos = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }


    public function getNomecompleto(): string
    {
        return $this->nomeCompleto;
    }

    public function setNomecompleto(string $nomeCompleto): void
    {
        $this->nomeCompleto = $nomeCompleto;
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

    public function getDatanascimento(): DateTime
    {
        return $this->dataNascimento;
    }

    public function setDatanascimento(DateTime $dataNascimento): void
    {
        $this->dataNascimento = $dataNascimento;
    }

    public function getEstado(): string
    {
        return $this->estado;
    }

    public function setEstado(string $estado): void
    {
        $this->estado = $estado;
    }

    public function getCidade(): string
    {
        return $this->cidade;
    }

    public function setCidade(string $cidade): void
    {
        $this->cidade = $cidade;
    }

    public function getEstadocivil(): string
    {
        return $this->estadoCivil;
    }

    public function setEstadocivil(string $estadoCivil): void
    {
        $this->estadoCivil = $estadoCivil;
    }

    public function getBairro(): string
    {
        return $this->bairro;
    }

    public function setBairro(string $bairro): void
    {
        $this->bairro = $bairro;
    }

    public function getPerfilfacebookinstagram(): ?string
    {
        return $this->perfilFacebookInstagram;
    }

    public function setPerfilfacebookinstagram(?string $perfilFacebookInstagram): void
    {
        $this->perfilFacebookInstagram = $perfilFacebookInstagram;
    }

    public function getPerfillinkedin(): ?string
    {
        return $this->perfilLinkedin;
    }

    public function setPerfillinkedin(?string $perfilLinkedin): void
    {
        $this->perfilLinkedin = $perfilLinkedin;
    }

    public function getComoconheceu(): string
    {
        return $this->comoConheceu;
    }

    public function setComoconheceu(string $comoConheceu): void
    {
        $this->comoConheceu = $comoConheceu;
    }

    public function getSalarioaceitavel(): string
    {
        return $this->salarioAceitavel;
    }

    public function setSalarioaceitavel(string $salarioAceitavel): void
    {
        $this->salarioAceitavel = $salarioAceitavel;
    }

    public function getSalariopretentido(): string
    {
        return $this->salarioPretentido;
    }

    public function setSalariopretentido(string $salarioPretentido): void
    {
        $this->salarioPretentido = $salarioPretentido;
    }

    public function getTempoexperiencia1(): string
    {
        return $this->tempoExperiencia1;
    }

    public function setTempoexperiencia1(string $tempoExperiencia1): void
    {
        $this->tempoExperiencia1 = $tempoExperiencia1;
    }

    public function getTempoexperiencia2(): string
    {
        return $this->tempoExperiencia2;
    }

    public function setTempoexperiencia2(string $tempoExperiencia2): void
    {
        $this->tempoExperiencia2 = $tempoExperiencia2;
    }

    public function getMensagem(): string
    {
        return $this->mensagem;
    }

    public function setMensagem(string $mensagem): void
    {
        $this->mensagem = $mensagem;
    }

    public function getPoliticaprivacidade(): ?bool
    {
        return $this->politicaPrivacidade;
    }

    public function setPoliticaprivacidade(?bool $politicaPrivacidade): void
    {
        $this->politicaPrivacidade = $politicaPrivacidade;
    }

    public function getCargo1(): ?Cargo
    {
        return $this->cargo1;
    }

    public function setCargo1(?Cargo $cargo1): void
    {
        $this->cargo1 = $cargo1;
    }


    public function getCargo2(): ?Cargo
    {
        return $this->cargo2;
    }

    public function setCargo2(?Cargo $cargo2): void
    {
        $this->cargo2 = $cargo2;
    }


    public function getCurriculo(): mixed
    {
        return $this->curriculo;
    }

    public function setCurriculo(mixed $curriculo): void
    {
        $this->curriculo = $curriculo;
    }


    public function getObjetivos(): Collection
    {
        return $this->objetivos;
    }

    public function setObjetivos(Collection $objetivos): void
    {
        $this->objetivos = $objetivos;
    }


    public function getSitesDesenvolvidos(): Collection
    {
        return $this->sitesDesenvolvidos;
    }

    public function setSitesDesenvolvidos(Collection $sitesDesenvolvidos): void
    {
        $this->sitesDesenvolvidos = $sitesDesenvolvidos;
    }



}