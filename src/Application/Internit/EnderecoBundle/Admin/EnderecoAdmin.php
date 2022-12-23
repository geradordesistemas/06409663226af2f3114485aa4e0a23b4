<?php
namespace App\Application\Internit\EnderecoBundle\Admin;

use App\Application\Internit\EnderecoBundle\Entity\Endereco;
use App\Application\Internit\EmpresaBundle\Entity\Empresa;

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
use Sonata\AdminBundle\Form\Type\ModelAutocompleteType;

final class EnderecoAdmin extends BaseAdmin
{

    public function toString(object $object): string
    {
        return $object instanceof Endereco ? $object->getId().''
        
        : '';
    }



    protected function configureFormFields(FormMapper $form): void
    {
        $form->tab('Geral');
            $form->with('Informações Gerais');


                $form->add('cep',  TextType::class, [
                    'label' => 'Cep',
                    'required' =>  false ,
                    
                ]);

                $form->add('pais',  TextType::class, [
                    'label' => 'Pais',
                    'required' =>  false ,
                    
                ]);

                $form->add('estado',  TextType::class, [
                    'label' => 'Estado',
                    'required' =>  false ,
                    
                ]);

                $form->add('cidade',  TextType::class, [
                    'label' => 'Cidade',
                    'required' =>  false ,
                    
                ]);

                $form->add('bairro',  TextType::class, [
                    'label' => 'Bairro',
                    'required' =>  false ,
                    
                ]);

                $form->add('rua',  TextType::class, [
                    'label' => 'Rua',
                    'required' =>  false ,
                    
                ]);

                $form->add('numero',  TextType::class, [
                    'label' => 'Numero',
                    'required' =>  false ,
                    
                ]);

                $form->add('complemento',  TextType::class, [
                    'label' => 'Complemento',
                    'required' =>  false ,
                    
                ]);


            $form->end();
        $form->end();
    }

    protected function configureDatagridFilters(DatagridMapper $datagrid): void
    {
        $datagrid->add('id', null, [
            'label' => 'Id',
        ]);

        $datagrid->add('cep', null, [
            'label' => 'Cep',
        ]);

        $datagrid->add('pais', null, [
            'label' => 'Pais',
        ]);

        $datagrid->add('estado', null, [
            'label' => 'Estado',
        ]);

        $datagrid->add('cidade', null, [
            'label' => 'Cidade',
        ]);

        $datagrid->add('bairro', null, [
            'label' => 'Bairro',
        ]);

        $datagrid->add('rua', null, [
            'label' => 'Rua',
        ]);

        $datagrid->add('numero', null, [
            'label' => 'Numero',
        ]);

        $datagrid->add('complemento', null, [
            'label' => 'Complemento',
        ]);

    $datagrid->add('empresas', ModelFilter::class, [
        'label' => 'Empresas',
        'field_options' => [
            'multiple' => true,
            'choice_label'=> function (Empresa $empresas) {
                return $empresas->getId()
                .' - '.$empresas->getNome()
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


        $list->addIdentifier('cep', null, [
            'label' => 'Cep',
                                                            
        ]);


        $list->addIdentifier('pais', null, [
            'label' => 'Pais',
                                                            
        ]);


        $list->addIdentifier('estado', null, [
            'label' => 'Estado',
                                                            
        ]);


        $list->addIdentifier('cidade', null, [
            'label' => 'Cidade',
                                                            
        ]);


        $list->addIdentifier('bairro', null, [
            'label' => 'Bairro',
                                                            
        ]);


        $list->addIdentifier('rua', null, [
            'label' => 'Rua',
                                                            
        ]);


        $list->addIdentifier('numero', null, [
            'label' => 'Numero',
                                                            
        ]);


        $list->addIdentifier('complemento', null, [
            'label' => 'Complemento',
                                                            
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

                $show->add('cep', null, [
                    'label' => 'Cep',
                                                            
                ]);

                $show->add('pais', null, [
                    'label' => 'Pais',
                                                            
                ]);

                $show->add('estado', null, [
                    'label' => 'Estado',
                                                            
                ]);

                $show->add('cidade', null, [
                    'label' => 'Cidade',
                                                            
                ]);

                $show->add('bairro', null, [
                    'label' => 'Bairro',
                                                            
                ]);

                $show->add('rua', null, [
                    'label' => 'Rua',
                                                            
                ]);

                $show->add('numero', null, [
                    'label' => 'Numero',
                                                            
                ]);

                $show->add('complemento', null, [
                    'label' => 'Complemento',
                                                            
                ]);



            $show->end();
        $show->end();
    }


}