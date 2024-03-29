<?php

namespace App\Application\Internit\SitesDesenvolvidosBundle\Form;

use App\Application\Internit\SitesDesenvolvidosBundle\Entity\SitesDesenvolvidos;
use App\Application\Internit\CurriculoBundle\Entity\Curriculo;

use Sonata\AdminBundle\Form\Type\ModelType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\SubmitButton;
use Symfony\Component\OptionsResolver\OptionsResolver;

/** Components Form */
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Sonata\AdminBundle\Form\Type\ModelAutocompleteType;


class SitesDesenvolvidosType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {


        $builder->add('url', TextType::class, [
            'label' => 'Url',
            'required' =>  true ,
            'attr' => ['class' => ' form-control mb-2 '],
            
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
