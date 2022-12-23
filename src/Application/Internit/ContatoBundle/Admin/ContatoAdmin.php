<?php
namespace App\Application\Internit\ContatoBundle\Admin;

use App\Application\Internit\ContatoBundle\Entity\Contato;
use App\Application\Internit\DepartamentoBundle\Entity\Departamento;

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
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Sonata\AdminBundle\Form\Type\ModelAutocompleteType;

final class ContatoAdmin extends BaseAdmin
{

    public function toString(object $object): string
    {
        return $object instanceof Contato ? $object->getId().''
        
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

                $form->add('email',  TextType::class, [
                    'label' => 'Email',
                    'required' =>  true ,
                    
                ]);

                $form->add('telefone',  TextType::class, [
                    'label' => 'Telefone',
                    'required' =>  true ,
                    
                ]);

                $form->add('mensagem',  TextareaType::class, [
                    'label' => 'Mensagem',
                    'required' =>  true ,
                    
                ]);

                $form->add('comoConheceu',  TextareaType::class, [
                    'label' => 'Comoconheceu',
                    'required' =>  true ,
                    
                ]);

                $form->add('receberInformativos',  CheckboxType::class, [
                    'label' => 'Receberinformativos',
                    'required' =>  false ,
                    
                ]);

                $form->add('politicaPrivacidade',  CheckboxType::class, [
                    'label' => 'Politicaprivacidade',
                    'required' =>  false ,
                    
                ]);

                $form->add('departamento', ModelAutocompleteType::class, [
                    'property' => 'id',
                    'placeholder' => 'Escolha o Departamento',
                    'help' => 'Filtros para pesquisa: [ id, nome, descricao, visivel,  ] - Exemplo de utilização: [ filtro=texto_pesquisa ]',
                    'minimum_input_length' => 0,
                    'items_per_page' => 10,
                    'quiet_millis' => 100,
                    'multiple' =>  false ,
                    'required' =>  false ,
                    'to_string_callback' => function($entity, $property) {
                        return $entity->getId() .' - '.$entity->getNome();
                    },
                    'callback' => static function (AdminInterface $admin, string $property, string $value): void {
                        $property = strtolower($property);
                        $value = strtolower($value);
                        $datagrid = $admin->getDatagrid();
                        $valueParts = explode('=', $value);
                        if (count($valueParts) === 2 && in_array($valueParts[0], [ "id","nome","descricao","visivel", ]))
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

        $datagrid->add('email', null, [
            'label' => 'Email',
        ]);

        $datagrid->add('telefone', null, [
            'label' => 'Telefone',
        ]);

        $datagrid->add('mensagem', null, [
            'label' => 'Mensagem',
        ]);

        $datagrid->add('comoConheceu', null, [
            'label' => 'Comoconheceu',
        ]);

        $datagrid->add('receberInformativos', null, [
            'label' => 'Receberinformativos',
        ]);

        $datagrid->add('politicaPrivacidade', null, [
            'label' => 'Politicaprivacidade',
        ]);

        $datagrid->add('departamento', ModelFilter::class, [
            'label' => 'Departamento',
            'field_options' => [
                'multiple' => true,
                'choice_label'=> function (Departamento $departamento) {
                    return $departamento->getId()
                    .' - '.$departamento->getNome()
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


        $list->addIdentifier('email', null, [
            'label' => 'Email',
                                                            
        ]);


        $list->addIdentifier('telefone', null, [
            'label' => 'Telefone',
                                                            
        ]);


        $list->addIdentifier('mensagem', null, [
            'label' => 'Mensagem',
                                                            
        ]);


        $list->addIdentifier('comoConheceu', null, [
            'label' => 'Comoconheceu',
                                                            
        ]);


        $list->add('receberInformativos', null, [
            'label' => 'Receberinformativos',
                                                'editable' => true,            'inverse' => false,
        ]);


        $list->add('politicaPrivacidade', null, [
            'label' => 'Politicaprivacidade',
                                                'editable' => true,            'inverse' => false,
        ]);


        $list->add('departamento', null, [
            'label' => 'Departamento',
            'associated_property' => function (Departamento $departamento) {
                return $departamento->getId()
                .' - '.$departamento->getNome()
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

                $show->add('email', null, [
                    'label' => 'Email',
                                                            
                ]);

                $show->add('telefone', null, [
                    'label' => 'Telefone',
                                                            
                ]);

                $show->add('mensagem', null, [
                    'label' => 'Mensagem',
                                                            
                ]);

                $show->add('comoConheceu', null, [
                    'label' => 'Comoconheceu',
                                                            
                ]);

                $show->add('receberInformativos', null, [
                    'label' => 'Receberinformativos',
                                                            
                ]);

                $show->add('politicaPrivacidade', null, [
                    'label' => 'Politicaprivacidade',
                                                            
                ]);

                $show->add('departamento', null, [
                    'label' => 'Departamento',
                    'associated_property' => function (Departamento $departamento) {
                        return $departamento->getId()
                        .' - '.$departamento->getNome()
                        ;
                    },
                ]);


            $show->end();
        $show->end();
    }


}