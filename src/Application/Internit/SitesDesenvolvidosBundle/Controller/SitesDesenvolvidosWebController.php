<?php

namespace App\Application\Internit\SitesDesenvolvidosBundle\Controller;

use App\Application\Internit\SitesDesenvolvidosBundle\Entity\SitesDesenvolvidos;
use App\Application\Internit\SitesDesenvolvidosBundle\Form\SitesDesenvolvidosType;

use App\Application\Project\ContentBundle\Controller\Base\BaseWebController;
use App\Application\Project\ContentBundle\Service\FilterDoctrine;
use App\Application\Project\ContentBundle\Attributes\Acl as ACL;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Persistence\ObjectRepository;
use Doctrine\Persistence\ManagerRegistry;


#[Route('/web/sitesDesenvolvidos', name: 'web_sitesDesenvolvidos_', methods: ['GET'])]
#[ACL\Web(enable: true, title: 'SitesDesenvolvidos', description: 'Permissões do modulo SitesDesenvolvidos')]
class SitesDesenvolvidosWebController extends BaseWebController
{
    public function getBaseRouter(): string
    {
        return 'web_sitesDesenvolvidos_';
    }

    public function getClass(): string
    {
        return SitesDesenvolvidos::class;
    }

    public function getRepository($doctrine): ObjectRepository
    {
        return $doctrine->getManager()->getRepository($this->getClass());
    }

    public function getBaseTemplate(): string
    {
        return "@ApplicationInternitSitesDesenvolvidos/sitesdesenvolvidos/";
    }

    #[Route('', name: 'list', methods: ['GET'])]
    #[ACL\Web(enable: true, title: 'Listar', description: 'Lista SitesDesenvolvidos')]
    public function listAction(ManagerRegistry $doctrine, Request $request): Response
    {
        $this->validateAccess(actionName: 'listAction');

        $filter = new FilterDoctrine(
            repository:  $this->getRepository($doctrine),
            request: $request,
            attributesFilters: [
                'id', 'url', 
            ]
        );

        return $this->render($this->getBaseTemplate() . 'list.html.twig', [
            'title' => 'Listar SitesDesenvolvidos',
            'objects' => $filter->getResult()->data,
        ]);
    }

    #[Route('/create', name: 'create', methods: ['GET', 'POST'])]
    #[ACL\Web(enable: true, title: 'Criar', description: 'Cria SitesDesenvolvidos')]
    public function createAction(ManagerRegistry $doctrine, Request $request): Response
    {
        $this->validateAccess(actionName: 'createAction');

        $entityManager = $doctrine->getManager();

        $data = new SitesDesenvolvidos();
        $form = $this->createForm(SitesDesenvolvidosType::class, $data);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $data = $form->getData();

            $entityManager->persist($data);
            $entityManager->flush();

            return $this->redirectToRoute($this->getBaseRouter() . 'list');
        }

        return $this->render($this->getBaseTemplate() . 'create.html.twig',[
            'title' => 'Criar SitesDesenvolvidos',
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}/show', name: 'show', methods: ['GET', 'POST'])]
    #[ACL\Web(enable: true, title: 'Visualizar', description: 'Visualiza SitesDesenvolvidos')]
    public function showAction(ManagerRegistry $doctrine, Request $request, int $id): Response
    {
        $this->validateAccess(actionName: 'showAction');

        $data = $doctrine->getRepository($this->getClass())->find($id);
        if(!$data)
            return $this->redirectToRoute($this->getBaseRouter() . 'list');

        $form = $this->createForm(SitesDesenvolvidosType::class, $data);

        return $this->render($this->getBaseTemplate() . 'show.html.twig',[
            'title' => 'Visualizar SitesDesenvolvidos',
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}/edit', name: 'edit', methods: ['GET', 'POST'])]
    #[ACL\Web(enable: true, title: 'Editar', description: 'Edita SitesDesenvolvidos')]
    public function editAction(ManagerRegistry $doctrine, Request $request, int $id): Response
    {
        $this->validateAccess(actionName: 'editAction');
        $entityManager = $doctrine->getManager();

        $data = $doctrine->getRepository($this->getClass())->find($id);
        if(!$data)
            return $this->redirectToRoute($this->getBaseRouter() . 'list');

        $form = $this->createForm(SitesDesenvolvidosType::class, $data);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $data = $form->getData();

            $entityManager->persist($data);
            $entityManager->flush();

            return $this->redirectToRoute($this->getBaseRouter() . 'list');
        }

        return $this->render($this->getBaseTemplate() . 'edit.html.twig',[
            'title' => 'Editar SitesDesenvolvidos',
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}/delete', name: 'delete', methods: ['GET'])]
    #[ACL\Web(enable: true, title: 'Deletar', description: 'Deleta SitesDesenvolvidos')]
    public function deleteAction(ManagerRegistry $doctrine, Request $request, int $id): Response
    {
        $this->validateAccess(actionName: 'deleteAction');

        $entityManager = $doctrine->getManager();

        $data = $entityManager->getRepository($this->getClass())->find($id);

        if (!$data)
            return $this->redirectToRoute($this->getBaseRouter() . 'list');

        $entityManager->remove($data);
        $entityManager->flush();

        return $this->redirectToRoute($this->getBaseRouter() . 'list');
    }

}