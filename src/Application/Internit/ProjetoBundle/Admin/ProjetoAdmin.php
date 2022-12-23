<?php
namespace App\Application\Internit\ProjetoBundle\Admin;

use App\Application\Internit\ProjetoBundle\Entity\Projeto;
use App\Application\Internit\SonataMediaMediaBundle\Entity\SonataMediaMedia;
use App\Application\Internit\SolucaoBundle\Entity\Solucao;
use App\Application\Internit\ClienteBundle\Entity\Cliente;

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

final class ProjetoAdmin extends BaseAdmin
{

    public function toString(object $object): string
    {
        return $object instanceof Projeto ? $object->getId().''
        
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

                $form->add('url',  TextType::class, [
                    'label' => 'Url',
                    'required' =>  false ,
                    
                ]);

                $form->add('logo', ModelListType::class,[
                    'label' => 'Logo: ',
                ]);

                $form->add('solucao', ModelAutocompleteType::class, [
                    'property' => 'id',
                    'placeholder' => 'Escolha o Solucao',
                    'help' => 'Filtros para pesquisa: [ id, nome, titulo, descricao,  ] - Exemplo de utilização: [ filtro=texto_pesquisa ]',
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
                        if (count($valueParts) === 2 && in_array($valueParts[0], [ "id","nome","titulo","descricao", ]))
                        [$property, $value] = $valueParts;

                        $datagrid->setValue($datagrid->getFilter($property)->getFormName(), null, $value);
                    },
                ]);

                $form->add('cliente', ModelAutocompleteType::class, [
                    'property' => 'id',
                    'placeholder' => 'Escolha o Cliente',
                    'help' => 'Filtros para pesquisa: [ id, nome, descricao,  ] - Exemplo de utilização: [ filtro=texto_pesquisa ]',
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
                        if (count($valueParts) === 2 && in_array($valueParts[0], [ "id","nome","descricao", ]))
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

        $datagrid->add('url', null, [
            'label' => 'Url',
        ]);


        $datagrid->add('solucao', ModelFilter::class, [
            'label' => 'Solucao',
            'field_options' => [
                'multiple' => true,
                'choice_label'=> function (Solucao $solucao) {
                    return $solucao->getId()
                    .' - '.$solucao->getNome()
                    ;
                },
            ],
        ]);

        $datagrid->add('cliente', ModelFilter::class, [
            'label' => 'Cliente',
            'field_options' => [
                'multiple' => true,
                'choice_label'=> function (Cliente $cliente) {
                    return $cliente->getId()
                    .' - '.$cliente->getNome()
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


        $list->addIdentifier('url', null, [
            'label' => 'Url',
                                                            
        ]);




        $list->add('solucao', null, [
            'label' => 'Solucao',
            'associated_property' => function (Solucao $solucao) {
                return $solucao->getId()
                .' - '.$solucao->getNome()
                ;
            },
        ]);


        $list->add('cliente', null, [
            'label' => 'Cliente',
            'associated_property' => function (Cliente $cliente) {
                return $cliente->getId()
                .' - '.$cliente->getNome()
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

                $show->add('url', null, [
                    'label' => 'Url',
                                                            
                ]);


                $show->add('solucao', null, [
                    'label' => 'Solucao',
                    'associated_property' => function (Solucao $solucao) {
                        return $solucao->getId()
                        .' - '.$solucao->getNome()
                        ;
                    },
                ]);

                $show->add('cliente', null, [
                    'label' => 'Cliente',
                    'associated_property' => function (Cliente $cliente) {
                        return $cliente->getId()
                        .' - '.$cliente->getNome()
                        ;
                    },
                ]);


            $show->end();
        $show->end();
    }


}