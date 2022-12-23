<?php

namespace App\Application\Internit\CurriculoBundle\Form;

use App\Application\Internit\CurriculoBundle\Entity\Curriculo;
use App\Application\Internit\CargoBundle\Entity\Cargo;
use App\Application\Internit\ObjetivoBundle\Entity\Objetivo;
use App\Application\Internit\SitesDesenvolvidosBundle\Entity\SitesDesenvolvidos;

use Sonata\AdminBundle\Form\Type\ModelType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\SubmitButton;
use Symfony\Component\OptionsResolver\OptionsResolver;

/** Components Form */
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Sonata\AdminBundle\Form\Type\ModelAutocompleteType;


class CurriculoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {


        $builder->add('nomeCompleto', TextType::class, [
            'label' => 'Nomecompleto',
            'required' =>  true ,
            'attr' => ['class' => ' form-control mb-2 '],
            
        ]);

        $builder->add('email', TextType::class, [
            'label' => 'Email',
            'required' =>  true ,
            'attr' => ['class' => ' form-control mb-2 '],
            
        ]);

        $builder->add('telefone', TextType::class, [
            'label' => 'Telefone',
            'required' =>  true ,
            'attr' => ['class' => ' form-control mb-2 '],
            
        ]);

        $builder->add('dataNascimento', DateType::class, [
            'label' => 'Datanascimento',
            'required' =>  true ,
            'attr' => ['class' => ' form-control mb-2 '],
            'widget' => 'single_text',
        ]);

        $builder->add('estado', TextType::class, [
            'label' => 'Estado',
            'required' =>  true ,
            'attr' => ['class' => ' form-control mb-2 '],
            
        ]);

        $builder->add('cidade', TextType::class, [
            'label' => 'Cidade',
            'required' =>  true ,
            'attr' => ['class' => ' form-control mb-2 '],
            
        ]);

        $builder->add('estadoCivil', TextType::class, [
            'label' => 'Estadocivil',
            'required' =>  true ,
            'attr' => ['class' => ' form-control mb-2 '],
            
        ]);

        $builder->add('bairro', TextType::class, [
            'label' => 'Bairro',
            'required' =>  true ,
            'attr' => ['class' => ' form-control mb-2 '],
            
        ]);

        $builder->add('perfilFacebookInstagram', TextType::class, [
            'label' => 'Perfilfacebookinstagram',
            'required' =>  false ,
            'attr' => ['class' => ' form-control mb-2 '],
            
        ]);

        $builder->add('perfilLinkedin', TextType::class, [
            'label' => 'Perfillinkedin',
            'required' =>  false ,
            'attr' => ['class' => ' form-control mb-2 '],
            
        ]);

        $builder->add('comoConheceu', TextareaType::class, [
            'label' => 'Comoconheceu',
            'required' =>  true ,
            'attr' => ['class' => ' form-control mb-2 '],
            
        ]);

        $builder->add('salarioAceitavel', TextType::class, [
            'label' => 'Salarioaceitavel',
            'required' =>  true ,
            'attr' => ['class' => ' form-control mb-2 '],
            
        ]);

        $builder->add('salarioPretentido', TextType::class, [
            'label' => 'Salariopretentido',
            'required' =>  true ,
            'attr' => ['class' => ' form-control mb-2 '],
            
        ]);

        $builder->add('tempoExperiencia1', TextType::class, [
            'label' => 'Tempoexperiencia1',
            'required' =>  true ,
            'attr' => ['class' => ' form-control mb-2 '],
            
        ]);

        $builder->add('tempoExperiencia2', TextType::class, [
            'label' => 'Tempoexperiencia2',
            'required' =>  true ,
            'attr' => ['class' => ' form-control mb-2 '],
            
        ]);

        $builder->add('mensagem', TextareaType::class, [
            'label' => 'Mensagem',
            'required' =>  true ,
            'attr' => ['class' => ' form-control mb-2 '],
            
        ]);

        $builder->add('politicaPrivacidade', CheckboxType::class, [
            'label' => 'Politicaprivacidade',
            'required' =>  false ,
            'attr' => ['class' => 'form-check-input'],
            
        ]);

        $builder->add('cargo1', EntityType::class, [
            'class' => Cargo::class,
            'choice_label' => function ($data) {
                return $data->getId() .' - '.$data->getCargo();
            },
            'label' => 'Cargo1',
            'required' =>  false ,
            'multiple' =>  false ,
            'attr' => ['class' => 'form-control mb-2 form-select'],
        ]);

        $builder->add('cargo2', EntityType::class, [
            'class' => Cargo::class,
            'choice_label' => function ($data) {
                return $data->getId() .' - '.$data->getCargo();
            },
            'label' => 'Cargo2',
            'required' =>  false ,
            'multiple' =>  false ,
            'attr' => ['class' => 'form-control mb-2 form-select'],
        ]);


        $builder->add('objetivos', EntityType::class, [
            'class' => Objetivo::class,
            'choice_label' => function ($data) {
                return $data->getId() .' - '.$data->getObjetivo();
            },
            'label' => 'Objetivos',
            'required' =>  false ,
            'multiple' =>  true ,
            'attr' => ['class' => 'form-control mb-2 form-select'],
        ]);

        $builder->add('sitesDesenvolvidos', EntityType::class, [
            'class' => SitesDesenvolvidos::class,
            'choice_label' => function ($data) {
                return $data->getId() .' - '.$data->getUrl();
            },
            'label' => 'SitesDesenvolvidos',
            'required' =>  false ,
            'multiple' =>  true ,
            'attr' => ['class' => 'form-control mb-2 form-select'],
        ]);


         $builder->add('enviar', SubmitType::class, [
            'attr' => ['type' => 'submit', 'class' => 'save btn btn-primary' ],
        ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
