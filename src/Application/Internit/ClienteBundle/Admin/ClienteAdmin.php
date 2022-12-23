<?php
namespace App\Application\Internit\ClienteBundle\Admin;

use App\Application\Internit\ClienteBundle\Entity\Cliente;
use App\Application\Internit\SonataMediaMediaBundle\Entity\SonataMediaMedia;
use App\Application\Internit\SetorAtuacaoBundle\Entity\SetorAtuacao;
use App\Application\Internit\ProjetoBundle\Entity\Projeto;

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

final class ClienteAdmin extends BaseAdmin
{

    public function toString(object $object): string
    {
        return $object instanceof Cliente ? $object->getId().''
        
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

                $form->add('logo', ModelListType::class,[
                    'label' => 'Logo: ',
                ]);

                $form->add('setorAtuacao', ModelAutocompleteType::class, [
                    'property' => 'id',
                    'placeholder' => 'Escolha o SetorAtuacao',
                    'help' => 'Filtros para pesquisa: [ id, nome, descricao,  ] - Exemplo de utilização: [ filtro=texto_pesquisa ]',
                    'minimum_input_length' => 0,
                    'items_per_page' => 10,
                    'quiet_millis' => 100,
                    'multiple' =>  true ,
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


        $datagrid->add('setorAtuacao', ModelFilter::class, [
            'label' => 'SetorAtuacao',
            'field_options' => [
                'multiple' => true,
                'choice_label'=> function (SetorAtuacao $setorAtuacao) {
                    return $setorAtuacao->getId()
                    .' - '.$setorAtuacao->getNome()
                    ;
                },
            ],
        ]);

    $datagrid->add('projetos', ModelFilter::class, [
        'label' => 'Projetos',
        'field_options' => [
            'multiple' => true,
            'choice_label'=> function (Projeto $projetos) {
                return $projetos->getId()
                .' - '.$projetos->getNome()
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




        $list->add('setorAtuacao', null, [
            'label' => 'SetorAtuacao',
            'associated_property' => function (SetorAtuacao $setorAtuacao) {
                return $setorAtuacao->getId()
                .' - '.$setorAtuacao->getNome()
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


                $show->add('setorAtuacao', null, [
                    'label' => 'SetorAtuacao',
                    'associated_property' => function (SetorAtuacao $setorAtuacao) {
                        return $setorAtuacao->getId()
                        .' - '.$setorAtuacao->getNome()
                        ;
                    },
                ]);



            $show->end();
        $show->end();
    }


}