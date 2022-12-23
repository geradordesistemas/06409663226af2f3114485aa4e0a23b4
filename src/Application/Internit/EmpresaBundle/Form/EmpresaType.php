<?php

namespace App\Application\Internit\EmpresaBundle\Form;

use App\Application\Internit\EmpresaBundle\Entity\Empresa;
use App\Application\Internit\EnderecoBundle\Entity\Endereco;

use Sonata\AdminBundle\Form\Type\ModelType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\SubmitButton;
use Symfony\Component\OptionsResolver\OptionsResolver;

/** Components Form */
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Sonata\AdminBundle\Form\Type\ModelAutocompleteType;


class EmpresaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {


        $builder->add('nome', TextType::class, [
            'label' => 'Nome',
            'required' =>  true ,
            'attr' => ['class' => ' form-control mb-2 '],
            
        ]);

        $builder->add('descricao', TextareaType::class, [
            'label' => 'Descricao',
            'required' =>  false ,
            'attr' => ['class' => ' form-control mb-2 '],
            
        ]);

        $builder->add('facebook', TextType::class, [
            'label' => 'Facebook',
            'required' =>  false ,
            'attr' => ['class' => ' form-control mb-2 '],
            
        ]);

        $builder->add('linkedin', TextType::class, [
            'label' => 'Linkedin',
            'required' =>  false ,
            'attr' => ['class' => ' form-control mb-2 '],
            
        ]);

        $builder->add('instragram', TextType::class, [
            'label' => 'Instragram',
            'required' =>  false ,
            'attr' => ['class' => ' form-control mb-2 '],
            
        ]);

        $builder->add('whatsApp', TextType::class, [
            'label' => 'Whatsapp',
            'required' =>  false ,
            'attr' => ['class' => ' form-control mb-2 '],
            
        ]);


        $builder->add('endereco', EntityType::class, [
            'class' => Endereco::class,
            'choice_label' => function ($data) {
                return $data->getId() .' - '.$data->getRua().' - '.$data->getNumero();
            },
            'label' => 'Endereco',
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
