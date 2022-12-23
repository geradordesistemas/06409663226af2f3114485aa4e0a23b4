<?php
namespace App\Application\Internit\SitesDesenvolvidosBundle\Admin;

use App\Application\Internit\SitesDesenvolvidosBundle\Entity\SitesDesenvolvidos;
use App\Application\Internit\CurriculoBundle\Entity\Curriculo;

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

final class SitesDesenvolvidosAdmin extends BaseAdmin
{

    public function toString(object $object): string
    {
        return $object instanceof SitesDesenvolvidos ? $object->getId().''
        
        : '';
    }



    protected function configureFormFields(FormMapper $form): void
    {
        $form->tab('Geral');
            $form->with('Informações Gerais');


                $form->add('url',  TextType::class, [
                    'label' => 'Url',
                    'required' =>  true ,
                    
                ]);


            $form->end();
        $form->end();
    }

    protected function configureDatagridFilters(DatagridMapper $datagrid): void
    {
        $datagrid->add('id', null, [
            'label' => 'Id',
        ]);

        $datagrid->add('url', null, [
            'label' => 'Url',
        ]);

    $datagrid->add('curriculos', ModelFilter::class, [
        'label' => 'Curriculos',
        'field_options' => [
            'multiple' => true,
            'choice_label'=> function (Curriculo $curriculos) {
                return $curriculos->getId()
                .' - '.$curriculos->getNomeCompleto()
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


        $list->addIdentifier('url', null, [
            'label' => 'Url',
                                                            
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

                $show->add('url', null, [
                    'label' => 'Url',
                                                            
                ]);



            $show->end();
        $show->end();
    }


}