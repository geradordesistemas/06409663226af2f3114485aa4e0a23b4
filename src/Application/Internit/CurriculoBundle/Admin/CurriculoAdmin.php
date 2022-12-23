<?php
namespace App\Application\Internit\CurriculoBundle\Admin;

use App\Application\Internit\CurriculoBundle\Entity\Curriculo;
use App\Application\Internit\CargoBundle\Entity\Cargo;
use App\Application\Internit\SonataMediaMediaBundle\Entity\SonataMediaMedia;
use App\Application\Internit\ObjetivoBundle\Entity\Objetivo;
use App\Application\Internit\SitesDesenvolvidosBundle\Entity\SitesDesenvolvidos;

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
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Sonata\AdminBundle\Form\Type\ModelAutocompleteType;

final class CurriculoAdmin extends BaseAdmin
{

    public function toString(object $object): string
    {
        return $object instanceof Curriculo ? $object->getId().''
        
        : '';
    }



    protected function configureFormFields(FormMapper $form): void
    {
        $form->tab('Geral');
            $form->with('Informações Gerais');


                $form->add('nomeCompleto',  TextType::class, [
                    'label' => 'Nomecompleto',
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

                $form->add('dataNascimento',  DateType::class, [
                    'label' => 'Datanascimento',
                    'required' =>  true ,
                    'widget' => 'single_text',
                ]);

                $form->add('estado',  TextType::class, [
                    'label' => 'Estado',
                    'required' =>  true ,
                    
                ]);

                $form->add('cidade',  TextType::class, [
                    'label' => 'Cidade',
                    'required' =>  true ,
                    
                ]);

                $form->add('estadoCivil',  TextType::class, [
                    'label' => 'Estadocivil',
                    'required' =>  true ,
                    
                ]);

                $form->add('bairro',  TextType::class, [
                    'label' => 'Bairro',
                    'required' =>  true ,
                    
                ]);

                $form->add('perfilFacebookInstagram',  TextType::class, [
                    'label' => 'Perfilfacebookinstagram',
                    'required' =>  false ,
                    
                ]);

                $form->add('perfilLinkedin',  TextType::class, [
                    'label' => 'Perfillinkedin',
                    'required' =>  false ,
                    
                ]);

                $form->add('comoConheceu',  TextareaType::class, [
                    'label' => 'Comoconheceu',
                    'required' =>  true ,
                    
                ]);

                $form->add('salarioAceitavel',  TextType::class, [
                    'label' => 'Salarioaceitavel',
                    'required' =>  true ,
                    
                ]);

                $form->add('salarioPretentido',  TextType::class, [
                    'label' => 'Salariopretentido',
                    'required' =>  true ,
                    
                ]);

                $form->add('tempoExperiencia1',  TextType::class, [
                    'label' => 'Tempoexperiencia1',
                    'required' =>  true ,
                    
                ]);

                $form->add('tempoExperiencia2',  TextType::class, [
                    'label' => 'Tempoexperiencia2',
                    'required' =>  true ,
                    
                ]);

                $form->add('mensagem',  TextareaType::class, [
                    'label' => 'Mensagem',
                    'required' =>  true ,
                    
                ]);

                $form->add('politicaPrivacidade',  CheckboxType::class, [
                    'label' => 'Politicaprivacidade',
                    'required' =>  false ,
                    
                ]);

                $form->add('cargo1', ModelAutocompleteType::class, [
                    'property' => 'id',
                    'placeholder' => 'Escolha o Cargo1',
                    'help' => 'Filtros para pesquisa: [ id, cargo, descricao, visivel,  ] - Exemplo de utilização: [ filtro=texto_pesquisa ]',
                    'minimum_input_length' => 0,
                    'items_per_page' => 10,
                    'quiet_millis' => 100,
                    'multiple' =>  false ,
                    'required' =>  false ,
                    'to_string_callback' => function($entity, $property) {
                        return $entity->getId() .' - '.$entity->getCargo();
                    },
                    'callback' => static function (AdminInterface $admin, string $property, string $value): void {
                        $property = strtolower($property);
                        $value = strtolower($value);
                        $datagrid = $admin->getDatagrid();
                        $valueParts = explode('=', $value);
                        if (count($valueParts) === 2 && in_array($valueParts[0], [ "id","cargo","descricao","visivel", ]))
                        [$property, $value] = $valueParts;

                        $datagrid->setValue($datagrid->getFilter($property)->getFormName(), null, $value);
                    },
                ]);

                $form->add('cargo2', ModelAutocompleteType::class, [
                    'property' => 'id',
                    'placeholder' => 'Escolha o Cargo2',
                    'help' => 'Filtros para pesquisa: [ id, cargo, descricao, visivel,  ] - Exemplo de utilização: [ filtro=texto_pesquisa ]',
                    'minimum_input_length' => 0,
                    'items_per_page' => 10,
                    'quiet_millis' => 100,
                    'multiple' =>  false ,
                    'required' =>  false ,
                    'to_string_callback' => function($entity, $property) {
                        return $entity->getId() .' - '.$entity->getCargo();
                    },
                    'callback' => static function (AdminInterface $admin, string $property, string $value): void {
                        $property = strtolower($property);
                        $value = strtolower($value);
                        $datagrid = $admin->getDatagrid();
                        $valueParts = explode('=', $value);
                        if (count($valueParts) === 2 && in_array($valueParts[0], [ "id","cargo","descricao","visivel", ]))
                        [$property, $value] = $valueParts;

                        $datagrid->setValue($datagrid->getFilter($property)->getFormName(), null, $value);
                    },
                ]);

                $form->add('curriculo', ModelListType::class,[
                    'label' => 'Curriculo: ',
                ]);

                $form->add('objetivos', ModelAutocompleteType::class, [
                    'property' => 'id',
                    'placeholder' => 'Escolha o Objetivos',
                    'help' => 'Filtros para pesquisa: [ id, objetivo, descricao, visivel,  ] - Exemplo de utilização: [ filtro=texto_pesquisa ]',
                    'minimum_input_length' => 0,
                    'items_per_page' => 10,
                    'quiet_millis' => 100,
                    'multiple' =>  true ,
                    'required' =>  false ,
                    'to_string_callback' => function($entity, $property) {
                        return $entity->getId() .' - '.$entity->getObjetivo();
                    },
                    'callback' => static function (AdminInterface $admin, string $property, string $value): void {
                        $property = strtolower($property);
                        $value = strtolower($value);
                        $datagrid = $admin->getDatagrid();
                        $valueParts = explode('=', $value);
                        if (count($valueParts) === 2 && in_array($valueParts[0], [ "id","objetivo","descricao","visivel", ]))
                        [$property, $value] = $valueParts;

                        $datagrid->setValue($datagrid->getFilter($property)->getFormName(), null, $value);
                    },
                ]);

                $form->add('sitesDesenvolvidos', ModelAutocompleteType::class, [
                    'property' => 'id',
                    'placeholder' => 'Escolha o SitesDesenvolvidos',
                    'help' => 'Filtros para pesquisa: [ id, url,  ] - Exemplo de utilização: [ filtro=texto_pesquisa ]',
                    'minimum_input_length' => 0,
                    'items_per_page' => 10,
                    'quiet_millis' => 100,
                    'multiple' =>  true ,
                    'required' =>  false ,
                    'to_string_callback' => function($entity, $property) {
                        return $entity->getId() .' - '.$entity->getUrl();
                    },
                    'callback' => static function (AdminInterface $admin, string $property, string $value): void {
                        $property = strtolower($property);
                        $value = strtolower($value);
                        $datagrid = $admin->getDatagrid();
                        $valueParts = explode('=', $value);
                        if (count($valueParts) === 2 && in_array($valueParts[0], [ "id","url", ]))
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

        $datagrid->add('nomeCompleto', null, [
            'label' => 'Nomecompleto',
        ]);

        $datagrid->add('email', null, [
            'label' => 'Email',
        ]);

        $datagrid->add('telefone', null, [
            'label' => 'Telefone',
        ]);

        $datagrid->add('dataNascimento', null, [
            'label' => 'Datanascimento',
            'field_options' => [
                'widget' => 'single_text',
            ],
        ]);

        $datagrid->add('estado', null, [
            'label' => 'Estado',
        ]);

        $datagrid->add('cidade', null, [
            'label' => 'Cidade',
        ]);

        $datagrid->add('estadoCivil', null, [
            'label' => 'Estadocivil',
        ]);

        $datagrid->add('bairro', null, [
            'label' => 'Bairro',
        ]);

        $datagrid->add('perfilFacebookInstagram', null, [
            'label' => 'Perfilfacebookinstagram',
        ]);

        $datagrid->add('perfilLinkedin', null, [
            'label' => 'Perfillinkedin',
        ]);

        $datagrid->add('comoConheceu', null, [
            'label' => 'Comoconheceu',
        ]);

        $datagrid->add('salarioAceitavel', null, [
            'label' => 'Salarioaceitavel',
        ]);

        $datagrid->add('salarioPretentido', null, [
            'label' => 'Salariopretentido',
        ]);

        $datagrid->add('tempoExperiencia1', null, [
            'label' => 'Tempoexperiencia1',
        ]);

        $datagrid->add('tempoExperiencia2', null, [
            'label' => 'Tempoexperiencia2',
        ]);

        $datagrid->add('mensagem', null, [
            'label' => 'Mensagem',
        ]);

        $datagrid->add('politicaPrivacidade', null, [
            'label' => 'Politicaprivacidade',
        ]);

        $datagrid->add('cargo1', ModelFilter::class, [
            'label' => 'Cargo1',
            'field_options' => [
                'multiple' => true,
                'choice_label'=> function (Cargo $cargo1) {
                    return $cargo1->getId()
                    .' - '.$cargo1->getCargo()
                    ;
                },
            ],
        ]);

        $datagrid->add('cargo2', ModelFilter::class, [
            'label' => 'Cargo2',
            'field_options' => [
                'multiple' => true,
                'choice_label'=> function (Cargo $cargo2) {
                    return $cargo2->getId()
                    .' - '.$cargo2->getCargo()
                    ;
                },
            ],
        ]);


        $datagrid->add('objetivos', ModelFilter::class, [
            'label' => 'Objetivos',
            'field_options' => [
                'multiple' => true,
                'choice_label'=> function (Objetivo $objetivos) {
                    return $objetivos->getId()
                    .' - '.$objetivos->getObjetivo()
                    ;
                },
            ],
        ]);

        $datagrid->add('sitesDesenvolvidos', ModelFilter::class, [
            'label' => 'SitesDesenvolvidos',
            'field_options' => [
                'multiple' => true,
                'choice_label'=> function (SitesDesenvolvidos $sitesDesenvolvidos) {
                    return $sitesDesenvolvidos->getId()
                    .' - '.$sitesDesenvolvidos->getUrl()
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


        $list->addIdentifier('nomeCompleto', null, [
            'label' => 'Nomecompleto',
                                                            
        ]);


        $list->addIdentifier('email', null, [
            'label' => 'Email',
                                                            
        ]);


        $list->addIdentifier('telefone', null, [
            'label' => 'Telefone',
                                                            
        ]);


        $list->addIdentifier('dataNascimento', null, [
            'label' => 'Datanascimento',
            'format'=> 'd/m/Y',                                                
        ]);


        $list->addIdentifier('estado', null, [
            'label' => 'Estado',
                                                            
        ]);


        $list->addIdentifier('cidade', null, [
            'label' => 'Cidade',
                                                            
        ]);


        $list->addIdentifier('estadoCivil', null, [
            'label' => 'Estadocivil',
                                                            
        ]);


        $list->addIdentifier('bairro', null, [
            'label' => 'Bairro',
                                                            
        ]);


        $list->addIdentifier('perfilFacebookInstagram', null, [
            'label' => 'Perfilfacebookinstagram',
                                                            
        ]);


        $list->addIdentifier('perfilLinkedin', null, [
            'label' => 'Perfillinkedin',
                                                            
        ]);


        $list->addIdentifier('comoConheceu', null, [
            'label' => 'Comoconheceu',
                                                            
        ]);


        $list->addIdentifier('salarioAceitavel', null, [
            'label' => 'Salarioaceitavel',
                                                            
        ]);


        $list->addIdentifier('salarioPretentido', null, [
            'label' => 'Salariopretentido',
                                                            
        ]);


        $list->addIdentifier('tempoExperiencia1', null, [
            'label' => 'Tempoexperiencia1',
                                                            
        ]);


        $list->addIdentifier('tempoExperiencia2', null, [
            'label' => 'Tempoexperiencia2',
                                                            
        ]);


        $list->addIdentifier('mensagem', null, [
            'label' => 'Mensagem',
                                                            
        ]);


        $list->add('politicaPrivacidade', null, [
            'label' => 'Politicaprivacidade',
                                                'editable' => true,            'inverse' => false,
        ]);


        $list->add('cargo1', null, [
            'label' => 'Cargo1',
            'associated_property' => function (Cargo $cargo1) {
                return $cargo1->getId()
                .' - '.$cargo1->getCargo()
                ;
            },
        ]);


        $list->add('cargo2', null, [
            'label' => 'Cargo2',
            'associated_property' => function (Cargo $cargo2) {
                return $cargo2->getId()
                .' - '.$cargo2->getCargo()
                ;
            },
        ]);




        $list->add('objetivos', null, [
            'label' => 'Objetivos',
            'associated_property' => function (Objetivo $objetivos) {
                return $objetivos->getId()
                .' - '.$objetivos->getObjetivo()
                ;
            },
        ]);


        $list->add('sitesDesenvolvidos', null, [
            'label' => 'SitesDesenvolvidos',
            'associated_property' => function (SitesDesenvolvidos $sitesDesenvolvidos) {
                return $sitesDesenvolvidos->getId()
                .' - '.$sitesDesenvolvidos->getUrl()
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

                $show->add('nomeCompleto', null, [
                    'label' => 'Nomecompleto',
                                                            
                ]);

                $show->add('email', null, [
                    'label' => 'Email',
                                                            
                ]);

                $show->add('telefone', null, [
                    'label' => 'Telefone',
                                                            
                ]);

                $show->add('dataNascimento', null, [
                    'label' => 'Datanascimento',
                    'format'=> 'd/m/Y',                                        
                ]);

                $show->add('estado', null, [
                    'label' => 'Estado',
                                                            
                ]);

                $show->add('cidade', null, [
                    'label' => 'Cidade',
                                                            
                ]);

                $show->add('estadoCivil', null, [
                    'label' => 'Estadocivil',
                                                            
                ]);

                $show->add('bairro', null, [
                    'label' => 'Bairro',
                                                            
                ]);

                $show->add('perfilFacebookInstagram', null, [
                    'label' => 'Perfilfacebookinstagram',
                                                            
                ]);

                $show->add('perfilLinkedin', null, [
                    'label' => 'Perfillinkedin',
                                                            
                ]);

                $show->add('comoConheceu', null, [
                    'label' => 'Comoconheceu',
                                                            
                ]);

                $show->add('salarioAceitavel', null, [
                    'label' => 'Salarioaceitavel',
                                                            
                ]);

                $show->add('salarioPretentido', null, [
                    'label' => 'Salariopretentido',
                                                            
                ]);

                $show->add('tempoExperiencia1', null, [
                    'label' => 'Tempoexperiencia1',
                                                            
                ]);

                $show->add('tempoExperiencia2', null, [
                    'label' => 'Tempoexperiencia2',
                                                            
                ]);

                $show->add('mensagem', null, [
                    'label' => 'Mensagem',
                                                            
                ]);

                $show->add('politicaPrivacidade', null, [
                    'label' => 'Politicaprivacidade',
                                                            
                ]);

                $show->add('cargo1', null, [
                    'label' => 'Cargo1',
                    'associated_property' => function (Cargo $cargo1) {
                        return $cargo1->getId()
                        .' - '.$cargo1->getCargo()
                        ;
                    },
                ]);

                $show->add('cargo2', null, [
                    'label' => 'Cargo2',
                    'associated_property' => function (Cargo $cargo2) {
                        return $cargo2->getId()
                        .' - '.$cargo2->getCargo()
                        ;
                    },
                ]);


                $show->add('objetivos', null, [
                    'label' => 'Objetivos',
                    'associated_property' => function (Objetivo $objetivos) {
                        return $objetivos->getId()
                        .' - '.$objetivos->getObjetivo()
                        ;
                    },
                ]);

                $show->add('sitesDesenvolvidos', null, [
                    'label' => 'SitesDesenvolvidos',
                    'associated_property' => function (SitesDesenvolvidos $sitesDesenvolvidos) {
                        return $sitesDesenvolvidos->getId()
                        .' - '.$sitesDesenvolvidos->getUrl()
                        ;
                    },
                ]);


            $show->end();
        $show->end();
    }


}