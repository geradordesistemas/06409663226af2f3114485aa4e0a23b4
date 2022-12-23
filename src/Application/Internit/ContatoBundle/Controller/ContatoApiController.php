<?php

namespace App\Application\Internit\ContatoBundle\Controller;

use App\Application\Internit\ContatoBundle\Repository\ContatoRepository;
use App\Application\Internit\ContatoBundle\Entity\Contato;

use App\Application\Project\ContentBundle\Controller\Base\BaseApiController;
use App\Application\Project\ContentBundle\Service\FilterDoctrine;
use App\Application\Project\ContentBundle\Attributes\Acl as ACL;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Persistence\ObjectRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\Query\QueryException;
use OpenApi\Attributes as OA;

#[Route('/api/contato', name: 'api_contato_')]
#[OA\Tag(name: 'Contato')]
#[ACL\Api(enable: true, title: 'Contato', description: 'Permissões do modulo Contato')]
class ContatoApiController extends BaseApiController
{

    public function getClass(): string
    {
        return Contato::class;
    }

    public function getRepository(): ObjectRepository
    {
        return $this->doctrine->getManager()->getRepository($this->getClass());
    }

    /** ****************************************************************************************** */
    /**
     * Recupera a coleção de recursos — Contato.
     * Recupera a coleção de recursos — Contato.
     * @throws QueryException
     */
    #[OA\Parameter( name: 'pagina', description: 'O número da página da coleção', in: 'query', required: false, allowEmptyValue: true, example: 1)]
    #[OA\Parameter( name: 'paginaTamanho', description: 'O tamanho da página da coleção', in: 'query', required: false, example: 10)]
    #[OA\Response(
        response: 200,
        description: 'Retorna Coleção de recursos Contato',
        content: new OA\JsonContent(
            properties: [
                new OA\Property(property: 'id', type: 'integer'),
                new OA\Property(property: 'nome', type: 'string'),
                new OA\Property(property: 'email', type: 'string'),
                new OA\Property(property: 'telefone', type: 'string'),
                new OA\Property(property: 'mensagem', type: 'string'),
                new OA\Property(property: 'comoConheceu', type: 'string'),
                new OA\Property(property: 'receberInformativos', type: 'boolean'),
                new OA\Property(property: 'politicaPrivacidade', type: 'boolean'),
                new OA\Property(property: 'departamento', type: 'integer' ),
            ],
            type: 'object'
        )
    )]
    #[Route('', name: 'list', methods: ['GET'])]
    #[ACL\Api(enable: true, title: 'Listar', description: 'Listar Contato')]
    public function listAction(Request $request): Response
    {
        $this->validateAccess(actionName: "listAction");

        $filter = new FilterDoctrine(
            repository:  $this->getRepository(),
            request: $request,
            attributesFilters: [
                'id', 'nome', 'email', 'telefone', 'mensagem', 'comoConheceu', 'receberInformativos', 'politicaPrivacidade', 'departamento', 
            ]
        );

        $response = $this->objectTransformer->ObjectToJson( $filter->getResult()->data, [
            'id', 'nome', 'email', 'telefone', 'mensagem', 'comoConheceu', 'receberInformativos', 'politicaPrivacidade', 'departamento', 
        ]);

        return $this->json([
            'resultado' => $response,
            'paginacao' => $filter->getResult()->paginator,
        ]);
    }

    /** ****************************************************************************************** */
    /**
     * Cria o Recurso — Contato.
     * Cria o Recurso — Contato.
     */
    #[OA\Response(
        response: 201,
        description: 'Retorna novo recurso Contato',
        content: new OA\JsonContent(
            properties: [
                new OA\Property(property: 'id', type: 'integer'),
                new OA\Property(property: 'nome', type: 'string'),
                new OA\Property(property: 'email', type: 'string'),
                new OA\Property(property: 'telefone', type: 'string'),
                new OA\Property(property: 'mensagem', type: 'string'),
                new OA\Property(property: 'comoConheceu', type: 'string'),
                new OA\Property(property: 'receberInformativos', type: 'boolean'),
                new OA\Property(property: 'politicaPrivacidade', type: 'boolean'),
                new OA\Property(property: 'departamento', type: 'integer' ),
            ],
            type: 'object'
        )
    )]
    #[OA\Response(response: 400, description: 'Dados inválidos!')]
    #[OA\RequestBody(
        description: 'Json Payload',
        content: new OA\JsonContent(
            properties: [
                new OA\Property(property: 'nome', type: 'string'),
                new OA\Property(property: 'email', type: 'string'),
                new OA\Property(property: 'telefone', type: 'string'),
                new OA\Property(property: 'mensagem', type: 'string'),
                new OA\Property(property: 'comoConheceu', type: 'string'),
                new OA\Property(property: 'receberInformativos', type: 'boolean'),
                new OA\Property(property: 'politicaPrivacidade', type: 'boolean'),
                new OA\Property(property: 'departamento', type: 'integer' ),
            ],
            type: 'object'
        )
    )]
    #[Route('', name: 'create', methods: ['POST'])]
    #[ACL\Api(enable: true, title: 'Criar', description: 'Criar Contato')]
    public function createAction(Request $request): Response
    {
        $this->validateAccess("createAction");

        if(!$request->getContent())
            return $this->json(['status' => false, 'message' => 'Dados inválidos!'], 400);

        /** Tranforma Corpo da requisação em um objeto da classe. */
        $object = $this->objectTransformer->JsonToObject( $this->getClass(), $request , [
            'nome', 'email', 'telefone', 'mensagem', 'comoConheceu', 'receberInformativos', 'politicaPrivacidade', 'departamento', 
        ]);

        /** Valida Restrições do objeto */
        $errors = $this->validateConstraintErros($object);
        if($errors)
            return $this->json($errors);

        $em = $this->doctrine->getManager();
        $em->persist($object);
        $em->flush();

        $response = $this->objectTransformer->ObjectToJson( $object, [
            'id', 'nome', 'email', 'telefone', 'mensagem', 'comoConheceu', 'receberInformativos', 'politicaPrivacidade', 'departamento', 
        ]);

        return $this->json($response, 201);
    }

    /** ****************************************************************************************** */
    /**
     * Recupera o recurso — Contato.
     * Recupera o recurso — Contato.
     */
    #[OA\Parameter( name: 'id', description: 'Identificador do recurso', in: 'path')]
    #[OA\Response(
        response: 200,
        description: 'Retorna recurso Contato',
        content: new OA\JsonContent(
            properties: [
                new OA\Property(property: 'id', type: 'integer'),
                new OA\Property(property: 'nome', type: 'string'),
                new OA\Property(property: 'email', type: 'string'),
                new OA\Property(property: 'telefone', type: 'string'),
                new OA\Property(property: 'mensagem', type: 'string'),
                new OA\Property(property: 'comoConheceu', type: 'string'),
                new OA\Property(property: 'receberInformativos', type: 'boolean'),
                new OA\Property(property: 'politicaPrivacidade', type: 'boolean'),
                new OA\Property(property: 'departamento', type: 'integer' ),
            ],
            type: 'object'
        )
    )]
    #[OA\Response(response: 404, description: 'Recurso não encontrado')]
    #[Route('/{id}', name: 'show', methods: ['GET'])]
    #[ACL\Api(enable: true, title: 'Visualizar', description: 'Visualizar Contato')]
    public function showAction(Request $request, mixed $id): Response
    {
        $this->validateAccess("showAction");

        $object = $this->getRepository()->find($id);
        if (!$object)
            return $this->json(['status' => false, 'message' => 'Contato não encontrado!'], 404);

        $response = $this->objectTransformer->ObjectToJson( $object, [
            'id', 'nome', 'email', 'telefone', 'mensagem', 'comoConheceu', 'receberInformativos', 'politicaPrivacidade', 'departamento', 
        ]);

        return $this->json($response);
    }

    /** ****************************************************************************************** */
    /**
     * Substitui o recurso — Contato.
     * Substitui o recurso — Contato.
     */
    #[OA\Parameter( name: 'id', description: 'Identificador do recurso', in: 'path')]
    #[OA\Response(
        response: 200,
        description: 'Retorna recurso Contato',
        content: new OA\JsonContent(
            properties: [
                new OA\Property(property: 'id', type: 'integer'),
                new OA\Property(property: 'nome', type: 'string'),
                new OA\Property(property: 'email', type: 'string'),
                new OA\Property(property: 'telefone', type: 'string'),
                new OA\Property(property: 'mensagem', type: 'string'),
                new OA\Property(property: 'comoConheceu', type: 'string'),
                new OA\Property(property: 'receberInformativos', type: 'boolean'),
                new OA\Property(property: 'politicaPrivacidade', type: 'boolean'),
                new OA\Property(property: 'departamento', type: 'integer' ),
            ],
            type: 'object'
        )
    )]
    #[OA\Response(response: 400, description: 'Dados inválidos!')]
    #[OA\Response(response: 404, description: 'Recurso não encontrado')]
    #[OA\RequestBody(
        description: 'Json Payload',
        content: new OA\JsonContent(
            properties: [
                new OA\Property(property: 'nome', type: 'string'),
                new OA\Property(property: 'email', type: 'string'),
                new OA\Property(property: 'telefone', type: 'string'),
                new OA\Property(property: 'mensagem', type: 'string'),
                new OA\Property(property: 'comoConheceu', type: 'string'),
                new OA\Property(property: 'receberInformativos', type: 'boolean'),
                new OA\Property(property: 'politicaPrivacidade', type: 'boolean'),
                new OA\Property(property: 'departamento', type: 'integer' ),
            ],
            type: 'object'
        )
    )]
    #[Route('/{id}', name: 'edit', methods: ['PUT','PATCH'])]
    #[ACL\Api(enable: true, title: 'Editar', description: 'Editar Contato')]
    public function editAction(Request $request, mixed $id): Response
    {
        $this->validateAccess("editAction");

        $object = $this->getRepository()->find($id);
        if(!$object)
            return $this->json(['status' => false, 'message' => 'Contato não encontrado!'], 404);

        /** Transforma corpo da requisição em um objeto da classe. */
        $object = $this->objectTransformer->JsonToObject($object, $request, [
            'nome', 'email', 'telefone', 'mensagem', 'comoConheceu', 'receberInformativos', 'politicaPrivacidade', 'departamento', 
        ]);

        /** Valida Restrições do objeto */
        $errors = $this->validateConstraintErros($object);
        if($errors)
            return $this->json($errors);

        /** Persiste o objeto */
        $em = $this->doctrine->getManager();
        $em->persist($object);
        $em->flush();

        $response = $this->objectTransformer->ObjectToJson( $object, [
            'id', 'nome', 'email', 'telefone', 'mensagem', 'comoConheceu', 'receberInformativos', 'politicaPrivacidade', 'departamento', 
        ]);

        return $this->json($response);
    }

    /** ****************************************************************************************** */
    /**
    * Remove o recurso — Contato.
    * Remove o recurso — Contato.
    */
    #[OA\Parameter( name: 'id', description: 'Identificador do recurso', in: 'path')]
    #[OA\Response(response: 204, description: 'Recurso excluído')]
    #[OA\Response(response: 404, description: 'Recurso não encontrado')]
    #[Route('/{id}', name: 'delete', methods: ['DELETE'])]
    #[ACL\Api(enable: true, title: 'Deletar', description: 'Deletar Contato')]
    public function deleteAction(mixed $id): Response
    {
        $this->validateAccess("deleteAction");

        $object = $this->getRepository()->find($id);
        if (!$object)
            return $this->json(['status' => false, 'message' => 'Contato não encontrado.'], 404);

        $em = $this->doctrine->getManager();
        $em->remove($object);
        $em->flush();

        return $this->json(['status' => true, 'message' => 'Contato removido com sucesso.'], 204);
    }

}