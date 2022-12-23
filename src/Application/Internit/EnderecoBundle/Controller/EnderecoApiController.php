<?php

namespace App\Application\Internit\EnderecoBundle\Controller;

use App\Application\Internit\EnderecoBundle\Repository\EnderecoRepository;
use App\Application\Internit\EnderecoBundle\Entity\Endereco;

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

#[Route('/api/endereco', name: 'api_endereco_')]
#[OA\Tag(name: 'Endereco')]
#[ACL\Api(enable: true, title: 'Endereco', description: 'Permissões do modulo Endereco')]
class EnderecoApiController extends BaseApiController
{

    public function getClass(): string
    {
        return Endereco::class;
    }

    public function getRepository(): ObjectRepository
    {
        return $this->doctrine->getManager()->getRepository($this->getClass());
    }

    /** ****************************************************************************************** */
    /**
     * Recupera a coleção de recursos — Endereco.
     * Recupera a coleção de recursos — Endereco.
     * @throws QueryException
     */
    #[OA\Parameter( name: 'pagina', description: 'O número da página da coleção', in: 'query', required: false, allowEmptyValue: true, example: 1)]
    #[OA\Parameter( name: 'paginaTamanho', description: 'O tamanho da página da coleção', in: 'query', required: false, example: 10)]
    #[OA\Response(
        response: 200,
        description: 'Retorna Coleção de recursos Endereco',
        content: new OA\JsonContent(
            properties: [
                new OA\Property(property: 'id', type: 'integer'),
                new OA\Property(property: 'cep', type: 'string'),
                new OA\Property(property: 'pais', type: 'string'),
                new OA\Property(property: 'estado', type: 'string'),
                new OA\Property(property: 'cidade', type: 'string'),
                new OA\Property(property: 'bairro', type: 'string'),
                new OA\Property(property: 'rua', type: 'string'),
                new OA\Property(property: 'numero', type: 'string'),
                new OA\Property(property: 'complemento', type: 'string'),
            ],
            type: 'object'
        )
    )]
    #[Route('', name: 'list', methods: ['GET'])]
    #[ACL\Api(enable: true, title: 'Listar', description: 'Listar Endereco')]
    public function listAction(Request $request): Response
    {
        $this->validateAccess(actionName: "listAction");

        $filter = new FilterDoctrine(
            repository:  $this->getRepository(),
            request: $request,
            attributesFilters: [
                'id', 'cep', 'pais', 'estado', 'cidade', 'bairro', 'rua', 'numero', 'complemento', 
            ]
        );

        $response = $this->objectTransformer->ObjectToJson( $filter->getResult()->data, [
            'id', 'cep', 'pais', 'estado', 'cidade', 'bairro', 'rua', 'numero', 'complemento', 
        ]);

        return $this->json([
            'resultado' => $response,
            'paginacao' => $filter->getResult()->paginator,
        ]);
    }

    /** ****************************************************************************************** */
    /**
     * Cria o Recurso — Endereco.
     * Cria o Recurso — Endereco.
     */
    #[OA\Response(
        response: 201,
        description: 'Retorna novo recurso Endereco',
        content: new OA\JsonContent(
            properties: [
                new OA\Property(property: 'id', type: 'integer'),
                new OA\Property(property: 'cep', type: 'string'),
                new OA\Property(property: 'pais', type: 'string'),
                new OA\Property(property: 'estado', type: 'string'),
                new OA\Property(property: 'cidade', type: 'string'),
                new OA\Property(property: 'bairro', type: 'string'),
                new OA\Property(property: 'rua', type: 'string'),
                new OA\Property(property: 'numero', type: 'string'),
                new OA\Property(property: 'complemento', type: 'string'),
            ],
            type: 'object'
        )
    )]
    #[OA\Response(response: 400, description: 'Dados inválidos!')]
    #[OA\RequestBody(
        description: 'Json Payload',
        content: new OA\JsonContent(
            properties: [
                new OA\Property(property: 'cep', type: 'string'),
                new OA\Property(property: 'pais', type: 'string'),
                new OA\Property(property: 'estado', type: 'string'),
                new OA\Property(property: 'cidade', type: 'string'),
                new OA\Property(property: 'bairro', type: 'string'),
                new OA\Property(property: 'rua', type: 'string'),
                new OA\Property(property: 'numero', type: 'string'),
                new OA\Property(property: 'complemento', type: 'string'),
            ],
            type: 'object'
        )
    )]
    #[Route('', name: 'create', methods: ['POST'])]
    #[ACL\Api(enable: true, title: 'Criar', description: 'Criar Endereco')]
    public function createAction(Request $request): Response
    {
        $this->validateAccess("createAction");

        if(!$request->getContent())
            return $this->json(['status' => false, 'message' => 'Dados inválidos!'], 400);

        /** Tranforma Corpo da requisação em um objeto da classe. */
        $object = $this->objectTransformer->JsonToObject( $this->getClass(), $request , [
            'cep', 'pais', 'estado', 'cidade', 'bairro', 'rua', 'numero', 'complemento', 
        ]);

        /** Valida Restrições do objeto */
        $errors = $this->validateConstraintErros($object);
        if($errors)
            return $this->json($errors);

        $em = $this->doctrine->getManager();
        $em->persist($object);
        $em->flush();

        $response = $this->objectTransformer->ObjectToJson( $object, [
            'id', 'cep', 'pais', 'estado', 'cidade', 'bairro', 'rua', 'numero', 'complemento', 
        ]);

        return $this->json($response, 201);
    }

    /** ****************************************************************************************** */
    /**
     * Recupera o recurso — Endereco.
     * Recupera o recurso — Endereco.
     */
    #[OA\Parameter( name: 'id', description: 'Identificador do recurso', in: 'path')]
    #[OA\Response(
        response: 200,
        description: 'Retorna recurso Endereco',
        content: new OA\JsonContent(
            properties: [
                new OA\Property(property: 'id', type: 'integer'),
                new OA\Property(property: 'cep', type: 'string'),
                new OA\Property(property: 'pais', type: 'string'),
                new OA\Property(property: 'estado', type: 'string'),
                new OA\Property(property: 'cidade', type: 'string'),
                new OA\Property(property: 'bairro', type: 'string'),
                new OA\Property(property: 'rua', type: 'string'),
                new OA\Property(property: 'numero', type: 'string'),
                new OA\Property(property: 'complemento', type: 'string'),
            ],
            type: 'object'
        )
    )]
    #[OA\Response(response: 404, description: 'Recurso não encontrado')]
    #[Route('/{id}', name: 'show', methods: ['GET'])]
    #[ACL\Api(enable: true, title: 'Visualizar', description: 'Visualizar Endereco')]
    public function showAction(Request $request, mixed $id): Response
    {
        $this->validateAccess("showAction");

        $object = $this->getRepository()->find($id);
        if (!$object)
            return $this->json(['status' => false, 'message' => 'Endereco não encontrado!'], 404);

        $response = $this->objectTransformer->ObjectToJson( $object, [
            'id', 'cep', 'pais', 'estado', 'cidade', 'bairro', 'rua', 'numero', 'complemento', 
        ]);

        return $this->json($response);
    }

    /** ****************************************************************************************** */
    /**
     * Substitui o recurso — Endereco.
     * Substitui o recurso — Endereco.
     */
    #[OA\Parameter( name: 'id', description: 'Identificador do recurso', in: 'path')]
    #[OA\Response(
        response: 200,
        description: 'Retorna recurso Endereco',
        content: new OA\JsonContent(
            properties: [
                new OA\Property(property: 'id', type: 'integer'),
                new OA\Property(property: 'cep', type: 'string'),
                new OA\Property(property: 'pais', type: 'string'),
                new OA\Property(property: 'estado', type: 'string'),
                new OA\Property(property: 'cidade', type: 'string'),
                new OA\Property(property: 'bairro', type: 'string'),
                new OA\Property(property: 'rua', type: 'string'),
                new OA\Property(property: 'numero', type: 'string'),
                new OA\Property(property: 'complemento', type: 'string'),
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
                new OA\Property(property: 'cep', type: 'string'),
                new OA\Property(property: 'pais', type: 'string'),
                new OA\Property(property: 'estado', type: 'string'),
                new OA\Property(property: 'cidade', type: 'string'),
                new OA\Property(property: 'bairro', type: 'string'),
                new OA\Property(property: 'rua', type: 'string'),
                new OA\Property(property: 'numero', type: 'string'),
                new OA\Property(property: 'complemento', type: 'string'),
            ],
            type: 'object'
        )
    )]
    #[Route('/{id}', name: 'edit', methods: ['PUT','PATCH'])]
    #[ACL\Api(enable: true, title: 'Editar', description: 'Editar Endereco')]
    public function editAction(Request $request, mixed $id): Response
    {
        $this->validateAccess("editAction");

        $object = $this->getRepository()->find($id);
        if(!$object)
            return $this->json(['status' => false, 'message' => 'Endereco não encontrado!'], 404);

        /** Transforma corpo da requisição em um objeto da classe. */
        $object = $this->objectTransformer->JsonToObject($object, $request, [
            'cep', 'pais', 'estado', 'cidade', 'bairro', 'rua', 'numero', 'complemento', 
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
            'id', 'cep', 'pais', 'estado', 'cidade', 'bairro', 'rua', 'numero', 'complemento', 
        ]);

        return $this->json($response);
    }

    /** ****************************************************************************************** */
    /**
    * Remove o recurso — Endereco.
    * Remove o recurso — Endereco.
    */
    #[OA\Parameter( name: 'id', description: 'Identificador do recurso', in: 'path')]
    #[OA\Response(response: 204, description: 'Recurso excluído')]
    #[OA\Response(response: 404, description: 'Recurso não encontrado')]
    #[Route('/{id}', name: 'delete', methods: ['DELETE'])]
    #[ACL\Api(enable: true, title: 'Deletar', description: 'Deletar Endereco')]
    public function deleteAction(mixed $id): Response
    {
        $this->validateAccess("deleteAction");

        $object = $this->getRepository()->find($id);
        if (!$object)
            return $this->json(['status' => false, 'message' => 'Endereco não encontrado.'], 404);

        $em = $this->doctrine->getManager();
        $em->remove($object);
        $em->flush();

        return $this->json(['status' => true, 'message' => 'Endereco removido com sucesso.'], 204);
    }

}