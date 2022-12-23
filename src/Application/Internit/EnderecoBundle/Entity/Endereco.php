<?php

namespace App\Application\Internit\EnderecoBundle\Entity;

use App\Application\Internit\EnderecoBundle\Repository\EnderecoRepository;
use App\Application\Internit\EmpresaBundle\Entity\Empresa;

use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use App\Entity\SonataMediaGallery;
use App\Entity\SonataMediaMedia;
use Doctrine\ORM\Mapping as ORM;
use DateTime;

/** Info:  */
#[ORM\Table(name: 'endereco')]
#[ORM\Entity(repositoryClass: EnderecoRepository::class)]
#[UniqueEntity('id')]
class Endereco
{

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'id', type: 'integer', unique: true, nullable: false)]
    private ?int $id = null;

    #[ORM\Column(name: 'cep', type: 'string', unique: false, nullable: true)]
    private ?string $cep = null;

    #[ORM\Column(name: 'pais', type: 'string', unique: false, nullable: true)]
    private ?string $pais = null;

    #[ORM\Column(name: 'estado', type: 'string', unique: false, nullable: true)]
    private ?string $estado = null;

    #[ORM\Column(name: 'cidade', type: 'string', unique: false, nullable: true)]
    private ?string $cidade = null;

    #[ORM\Column(name: 'bairro', type: 'string', unique: false, nullable: true)]
    private ?string $bairro = null;

    #[ORM\Column(name: 'rua', type: 'string', unique: false, nullable: true)]
    private ?string $rua = null;

    #[ORM\Column(name: 'numero', type: 'string', unique: false, nullable: true)]
    private ?string $numero = null;

    #[ORM\Column(name: 'complemento', type: 'string', unique: false, nullable: true)]
    private ?string $complemento = null;

    #[ORM\ManyToMany(targetEntity: Empresa::class, mappedBy: 'endereco')]
    private Collection $empresas;


    public function __construct()
    {
        $this->empresas = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }


    public function getCep(): ?string
    {
        return $this->cep;
    }

    public function setCep(?string $cep): void
    {
        $this->cep = $cep;
    }

    public function getPais(): ?string
    {
        return $this->pais;
    }

    public function setPais(?string $pais): void
    {
        $this->pais = $pais;
    }

    public function getEstado(): ?string
    {
        return $this->estado;
    }

    public function setEstado(?string $estado): void
    {
        $this->estado = $estado;
    }

    public function getCidade(): ?string
    {
        return $this->cidade;
    }

    public function setCidade(?string $cidade): void
    {
        $this->cidade = $cidade;
    }

    public function getBairro(): ?string
    {
        return $this->bairro;
    }

    public function setBairro(?string $bairro): void
    {
        $this->bairro = $bairro;
    }

    public function getRua(): ?string
    {
        return $this->rua;
    }

    public function setRua(?string $rua): void
    {
        $this->rua = $rua;
    }

    public function getNumero(): ?string
    {
        return $this->numero;
    }

    public function setNumero(?string $numero): void
    {
        $this->numero = $numero;
    }

    public function getComplemento(): ?string
    {
        return $this->complemento;
    }

    public function setComplemento(?string $complemento): void
    {
        $this->complemento = $complemento;
    }

    public function getEmpresas(): Collection
    {
        return $this->empresas;
    }

    public function setEmpresas(Collection $empresas): void
    {
        $this->empresas = $empresas;
    }



}