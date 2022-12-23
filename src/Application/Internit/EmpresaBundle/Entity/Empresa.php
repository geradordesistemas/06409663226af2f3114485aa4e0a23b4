<?php

namespace App\Application\Internit\EmpresaBundle\Entity;

use App\Application\Internit\EmpresaBundle\Repository\EmpresaRepository;
use App\Application\Internit\EnderecoBundle\Entity\Endereco;

use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use App\Entity\SonataMediaGallery;
use App\Entity\SonataMediaMedia;
use Doctrine\ORM\Mapping as ORM;
use DateTime;

/** Info:  */
#[ORM\Table(name: 'empresa')]
#[ORM\Entity(repositoryClass: EmpresaRepository::class)]
#[UniqueEntity('id')]
class Empresa
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

    #[ORM\Column(name: 'facebook', type: 'string', unique: false, nullable: true)]
    private ?string $facebook = null;

    #[ORM\Column(name: 'linkedin', type: 'string', unique: false, nullable: true)]
    private ?string $linkedin = null;

    #[ORM\Column(name: 'instragram', type: 'string', unique: false, nullable: true)]
    private ?string $instragram = null;

    #[ORM\Column(name: 'whatsApp', type: 'string', unique: false, nullable: true)]
    private ?string $whatsApp = null;

    #[ORM\ManyToOne(targetEntity: SonataMediaMedia::class, cascade: ['persist'])]
    private mixed $logo;

    #[ORM\JoinTable(name: 'endereco_empresa')]
    #[ORM\JoinColumn(name: 'empresa_id', referencedColumnName: 'id')] // , onDelete: 'SET NULL'
    #[ORM\InverseJoinColumn(name: 'endereco_id', referencedColumnName: 'id')]
    #[ORM\ManyToMany(targetEntity: Endereco::class, inversedBy: 'empresas')]
    private Collection $endereco;


    public function __construct()
    {
        $this->endereco = new ArrayCollection();
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

    public function getFacebook(): ?string
    {
        return $this->facebook;
    }

    public function setFacebook(?string $facebook): void
    {
        $this->facebook = $facebook;
    }

    public function getLinkedin(): ?string
    {
        return $this->linkedin;
    }

    public function setLinkedin(?string $linkedin): void
    {
        $this->linkedin = $linkedin;
    }

    public function getInstragram(): ?string
    {
        return $this->instragram;
    }

    public function setInstragram(?string $instragram): void
    {
        $this->instragram = $instragram;
    }

    public function getWhatsapp(): ?string
    {
        return $this->whatsApp;
    }

    public function setWhatsapp(?string $whatsApp): void
    {
        $this->whatsApp = $whatsApp;
    }

    public function getLogo(): mixed
    {
        return $this->logo;
    }

    public function setLogo(mixed $logo): void
    {
        $this->logo = $logo;
    }


    public function getEndereco(): Collection
    {
        return $this->endereco;
    }

    public function setEndereco(Collection $endereco): void
    {
        $this->endereco = $endereco;
    }



}