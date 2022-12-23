<?php
namespace App\Application\Internit\EmpresaBundle\Admin;

use App\Application\Internit\EmpresaBundle\Entity\Empresa;
use App\Application\Internit\SonataMediaMediaBundle\Entity\SonataMediaMedia;
use App\Application\Internit\EnderecoBundle\Entity\Endereco;

use App\Application\Project\ContentBundle\Admin\Base\BaseAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Admin\AdminInterface;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

/** Components Form */
use Sonata\DoctrineORMAdminBundle\Filter\ModelFilter;
use Sonata\AdminBundle\Form\Type\ModelListType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Sonata\AdminBundle\Form\Type\ModelAutocompleteType;

final class EmpresaAdmin extends BaseAdmin
{

    public function toString(object $object): string
    {
        return $object instanceof Empresa ? $object->getId().''
        
        : '';
    }



    protected function configureFormFields(FormMapper $form): void
    {
        $form->tab('Geral');
            $form->with('Informações Gerais');


                $form->add('nome',  TextType::class, [
                    'label' => 'Nome',
                    'required' =>  true ,
                    
                ]);

                $form->add('descricao',  TextareaType::class, [
                    'label' => 'Descricao',
                    'required' =>  false ,
                    
                ]);

                $form->add('facebook',  TextType::class, [
                    'label' => 'Facebook',
                    'required' =>  false ,
                    
                ]);

                $form->add('linkedin',  TextType::class, [
                    'label' => 'Linkedin',
                    'required' =>  false ,
                    
                ]);

                $form->add('instragram',  TextType::class, [
                    'label' => 'Instragram',
                    'required' =>  false ,
                    
                ]);

                $form->add('whatsApp',  TextType::class, [
                    'label' => 'Whatsapp',
                    'required' =>  false ,
                    
                ]);

                $form->add('logo', ModelListType::class,[
                    'label' => 'Logo: ',
                ]);

                $form->add('endereco', ModelAutocompleteType::class, [
                    'property' => 'id',
                    'placeholder' => 'Escolha o Endereco',
                    'help' => 'Filtros para pesquisa: [ id, cep, pais, estado, cidade, bairro, rua, numero, complemento,  ] - Exemplo de utilização: [ filtro=texto_pesquisa ]',
                    'minimum_input_length' => 0,
                    'items_per_page' => 10,
                    'quiet_millis' => 100,
                    'multiple' =>  true ,
                    'required' =>  false ,
                    'to_string_callback' => function($entity, $property) {
                        return $entity->getId() .' - '.$entity->getRua().' - '.$entity->getNumero();
                    },
                    'callback' => static function (AdminInterface $admin, string $property, string $value): void {
                        $property = strtolower($property);
                        $value = strtolower($value);
                        $datagrid = $admin->getDatagrid();
                        $valueParts = explode('=', $value);
                        if (count($valueParts) === 2 && in_array($valueParts[0], [ "id","cep","pais","estado","cidade","bairro","rua","numero","complemento", ]))
                        [$property, $value] = $valueParts;

                        $datagrid->setValue($datagrid->getFilter($property)->getFormName(), null, $value);
                    },
                ]);

            $form->end();
        $form->end();
    }

    protected function configureDatagridFilters(DatagridMapper $datagrid): void
    {
        $datagrid->add('id', null, [
            'label' => 'Id',
        ]);

        $datagrid->add('nome', null, [
            'label' => 'Nome',
        ]);

        $datagrid->add('descricao', null, [
            'label' => 'Descricao',
        ]);

        $datagrid->add('facebook', null, [
            'label' => 'Facebook',
        ]);

        $datagrid->add('linkedin', null, [
            'label' => 'Linkedin',
        ]);

        $datagrid->add('instragram', null, [
            'label' => 'Instragram',
        ]);

        $datagrid->add('whatsApp', null, [
            'label' => 'Whatsapp',
        ]);


        $datagrid->add('endereco', ModelFilter::class, [
            'label' => 'Endereco',
            'field_options' => [
                'multiple' => true,
                'choice_label'=> function (Endereco $endereco) {
                    return $endereco->getId()
                    .' - '.$endereco->getRua()
                    .' - '.$endereco->getNumero()
                    ;
                },
            ],
        ]);

    }

    protected function configureListFields(ListMapper $list): void
    {

        $list->addIdentifier('id', null, [
            'label' => 'Id',
                                                            
        ]);


        $list->addIdentifier('nome', null, [
            'label' => 'Nome',
                                                            
        ]);


        $list->addIdentifier('descricao', null, [
            'label' => 'Descricao',
                                                            
        ]);


        $list->addIdentifier('facebook', null, [
            'label' => 'Facebook',
                                                            
        ]);


        $list->addIdentifier('linkedin', null, [
            'label' => 'Linkedin',
                                                            
        ]);


        $list->addIdentifier('instragram', null, [
            'label' => 'Instragram',
                                                            
        ]);


        $list->addIdentifier('whatsApp', null, [
            'label' => 'Whatsapp',
                                                            
        ]);




        $list->add('endereco', null, [
            'label' => 'Endereco',
            'associated_property' => function (Endereco $endereco) {
                return $endereco->getId()
                .' - '.$endereco->getRua()
                .' - '.$endereco->getNumero()
                ;
            },
        ]);


        $list->add(ListMapper::NAME_ACTIONS, ListMapper::TYPE_ACTIONS, [
            'actions' => [
                'show'   => [],
                'edit'   => [],
                'delete' => [],
            ]
        ]);

    }

    protected function configureShowFields(ShowMapper $show): void
    {
        $show->tab('Geral');
            $show->with('Informações Gerais', [
                'class'       => 'col-md-12',
                'box_class'   => 'box box-solid box-primary',
                'description' => 'Informações Gerais',
            ]);

                $show->add('id', null, [
                    'label' => 'Id',
                                                            
                ]);

                $show->add('nome', null, [
                    'label' => 'Nome',
                                                            
                ]);

                $show->add('descricao', null, [
                    'label' => 'Descricao',
                                                            
                ]);

                $show->add('facebook', null, [
                    'label' => 'Facebook',
                                                            
                ]);

                $show->add('linkedin', null, [
                    'label' => 'Linkedin',
                                                            
                ]);

                $show->add('instragram', null, [
                    'label' => 'Instragram',
                                                            
                ]);

                $show->add('whatsApp', null, [
                    'label' => 'Whatsapp',
                                                            
                ]);


                $show->add('endereco', null, [
                    'label' => 'Endereco',
                    'associated_property' => function (Endereco $endereco) {
                        return $endereco->getId()
                        .' - '.$endereco->getRua()
                        .' - '.$endereco->getNumero()
                        ;
                    },
                ]);


            $show->end();
        $show->end();
    }


}