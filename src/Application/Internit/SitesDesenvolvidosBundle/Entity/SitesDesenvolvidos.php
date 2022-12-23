<?php

namespace App\Application\Internit\SitesDesenvolvidosBundle\Entity;

use App\Application\Internit\SitesDesenvolvidosBundle\Repository\SitesDesenvolvidosRepository;
use App\Application\Internit\CurriculoBundle\Entity\Curriculo;

use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use App\Entity\SonataMediaGallery;
use App\Entity\SonataMediaMedia;
use Doctrine\ORM\Mapping as ORM;
use DateTime;

/** Info:  */
#[ORM\Table(name: 'sites_desenvolvidos')]
#[ORM\Entity(repositoryClass: SitesDesenvolvidosRepository::class)]
#[UniqueEntity('id')]
class SitesDesenvolvidos
{

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'id', type: 'integer', unique: true, nullable: false)]
    private ?int $id = null;

    #[Assert\NotNull]
    #[Assert\NotBlank]
    #[ORM\Column(name: 'url', type: 'string', unique: false, nullable: false)]
    private string $url;

    #[ORM\ManyToMany(targetEntity: Curriculo::class, mappedBy: 'sitesDesenvolvidos')]
    private Collection $curriculos;


    public function __construct()
    {
        $this->curriculos = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }


    public function getUrl(): string
    {
        return $this->url;
    }

    public function setUrl(string $url): void
    {
        $this->url = $url;
    }

    public function getCurriculos(): Collection
    {
        return $this->curriculos;
    }

    public function setCurriculos(Collection $curriculos): void
    {
        $this->curriculos = $curriculos;
    }



}