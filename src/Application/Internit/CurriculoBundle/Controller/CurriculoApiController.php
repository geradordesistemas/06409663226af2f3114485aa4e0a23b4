<?php

namespace App\Application\Internit\CurriculoBundle\Controller;

use App\Application\Internit\CurriculoBundle\Repository\CurriculoRepository;
use App\Application\Internit\CurriculoBundle\Entity\Curriculo;

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

#[Route('/api/curriculo', name: 'api_curriculo_')]
#[OA\Tag(name: 'Curriculo')]
#[ACL\Api(enable: true, title: 'Curriculo', description: 'Permissões do modulo Curriculo')]
class CurriculoApiController extends BaseApiController
{

    public function getClass(): string
    {
        return Curriculo::class;
    }

    public function getRepository(): ObjectRepository
    {
        return $this->doctrine->getManager()->getRepository($this->getClass());
    }

    /** ****************************************************************************************** */
    /**
     * Recupera a coleção de recursos — Curriculo.
     * Recupera a coleção de recursos — Curriculo.
     * @throws QueryException
     */
    #[OA\Parameter( name: 'pagina', description: 'O número da página da coleção', in: 'query', required: false, allowEmptyValue: true, example: 1)]
    #[OA\Parameter( name: 'paginaTamanho', description: 'O tamanho da página da coleção', in: 'query', required: false, example: 10)]
    #[OA\Response(
        response: 200,
        description: 'Retorna Coleção de recursos Curriculo',
        content: new OA\JsonContent(
            properties: [
                new OA\Property(property: 'id', type: 'integer'),
                new OA\Property(property: 'nomeCompleto', type: 'string'),
                new OA\Property(property: 'email', type: 'string'),
                new OA\Property(property: 'telefone', type: 'string'),
                new OA\Property(property: 'dataNascimento', type: 'string'),
                new OA\Property(property: 'estado', type: 'string'),
                new OA\Property(property: 'cidade', type: 'string'),
                new OA\Property(property: 'estadoCivil', type: 'string'),
                new OA\Property(property: 'bairro', type: 'string'),
                new OA\Property(property: 'perfilFacebookInstagram', type: 'string'),
                new OA\Property(property: 'perfilLinkedin', type: 'string'),
                new OA\Property(property: 'comoConheceu', type: 'string'),
                new OA\Property(property: 'salarioAceitavel', type: 'string'),
                new OA\Property(property: 'salarioPretentido', type: 'string'),
                new OA\Property(property: 'tempoExperiencia1', type: 'string'),
                new OA\Property(property: 'tempoExperiencia2', type: 'string'),
                new OA\Property(property: 'mensagem', type: 'string'),
                new OA\Property(property: 'politicaPrivacidade', type: 'boolean'),
                new OA\Property(property: 'cargo1', type: 'integer' ),
                new OA\Property(property: 'cargo2', type: 'integer' ),
                new OA\Property(property: 'curriculo', type: 'integer' ),
                new OA\Property(property: 'objetivos', type: 'array', items: new OA\Items(type: 'integer') ),
                new OA\Property(property: 'sitesDesenvolvidos', type: 'array', items: new OA\Items(type: 'integer') ),
            ],
            type: 'object'
        )
    )]
    #[Route('', name: 'list', methods: ['GET'])]
    #[ACL\Api(enable: true, title: 'Listar', description: 'Listar Curriculo')]
    public function listAction(Request $request): Response
    {
        $this->validateAccess(actionName: "listAction");

        $filter = new FilterDoctrine(
            repository:  $this->getRepository(),
            request: $request,
            attributesFilters: [
                'id', 'nomeCompleto', 'email', 'telefone', 'dataNascimento', 'estado', 'cidade', 'estadoCivil', 'bairro', 'perfilFacebookInstagram', 'perfilLinkedin', 'comoConheceu', 'salarioAceitavel', 'salarioPretentido', 'tempoExperiencia1', 'tempoExperiencia2', 'mensagem', 'politicaPrivacidade', 'cargo1', 'cargo2', 'curriculo', 
            ]
        );

        $response = $this->objectTransformer->ObjectToJson( $filter->getResult()->data, [
            'id', 'nomeCompleto', 'email', 'telefone', 'dataNascimento', 'estado', 'cidade', 'estadoCivil', 'bairro', 'perfilFacebookInstagram', 'perfilLinkedin', 'comoConheceu', 'salarioAceitavel', 'salarioPretentido', 'tempoExperiencia1', 'tempoExperiencia2', 'mensagem', 'politicaPrivacidade', 'cargo1', 'cargo2', 'curriculo', 'objetivos', 'sitesDesenvolvidos', 
        ]);

        return $this->json([
            'resultado' => $response,
            'paginacao' => $filter->getResult()->paginator,
        ]);
    }

    /** ****************************************************************************************** */
    /**
     * Cria o Recurso — Curriculo.
     * Cria o Recurso — Curriculo.
     */
    #[OA\Response(
        response: 201,
        description: 'Retorna novo recurso Curriculo',
        content: new OA\JsonContent(
            properties: [
                new OA\Property(property: 'id', type: 'integer'),
                new OA\Property(property: 'nomeCompleto', type: 'string'),
                new OA\Property(property: 'email', type: 'string'),
                new OA\Property(property: 'telefone', type: 'string'),
                new OA\Property(property: 'dataNascimento', type: 'string'),
                new OA\Property(property: 'estado', type: 'string'),
                new OA\Property(property: 'cidade', type: 'string'),
                new OA\Property(property: 'estadoCivil', type: 'string'),
                new OA\Property(property: 'bairro', type: 'string'),
                new OA\Property(property: 'perfilFacebookInstagram', type: 'string'),
                new OA\Property(property: 'perfilLinkedin', type: 'string'),
                new OA\Property(property: 'comoConheceu', type: 'string'),
                new OA\Property(property: 'salarioAceitavel', type: 'string'),
                new OA\Property(property: 'salarioPretentido', type: 'string'),
                new OA\Property(property: 'tempoExperiencia1', type: 'string'),
                new OA\Property(property: 'tempoExperiencia2', type: 'string'),
                new OA\Property(property: 'mensagem', type: 'string'),
                new OA\Property(property: 'politicaPrivacidade', type: 'boolean'),
                new OA\Property(property: 'cargo1', type: 'integer' ),
                new OA\Property(property: 'cargo2', type: 'integer' ),
                new OA\Property(property: 'curriculo', type: 'integer' ),
                new OA\Property(property: 'objetivos', type: 'array', items: new OA\Items(type: 'integer') ),
                new OA\Property(property: 'sitesDesenvolvidos', type: 'array', items: new OA\Items(type: 'integer') ),
            ],
            type: 'object'
        )
    )]
    #[OA\Response(response: 400, description: 'Dados inválidos!')]
    #[OA\RequestBody(
        description: 'Json Payload',
        content: new OA\JsonContent(
            properties: [
                new OA\Property(property: 'nomeCompleto', type: 'string'),
                new OA\Property(property: 'email', type: 'string'),
                new OA\Property(property: 'telefone', type: 'string'),
                new OA\Property(property: 'dataNascimento', type: 'string'),
                new OA\Property(property: 'estado', type: 'string'),
                new OA\Property(property: 'cidade', type: 'string'),
                new OA\Property(property: 'estadoCivil', type: 'string'),
                new OA\Property(property: 'bairro', type: 'string'),
                new OA\Property(property: 'perfilFacebookInstagram', type: 'string'),
                new OA\Property(property: 'perfilLinkedin', type: 'string'),
                new OA\Property(property: 'comoConheceu', type: 'string'),
                new OA\Property(property: 'salarioAceitavel', type: 'string'),
                new OA\Property(property: 'salarioPretentido', type: 'string'),
                new OA\Property(property: 'tempoExperiencia1', type: 'string'),
                new OA\Property(property: 'tempoExperiencia2', type: 'string'),
                new OA\Property(property: 'mensagem', type: 'string'),
                new OA\Property(property: 'politicaPrivacidade', type: 'boolean'),
                new OA\Property(property: 'cargo1', type: 'integer' ),
                new OA\Property(property: 'cargo2', type: 'integer' ),
                new OA\Property(property: 'curriculo', type: 'integer' ),
                new OA\Property(property: 'objetivos', type: 'array', items: new OA\Items(type: 'integer') ),
                new OA\Property(property: 'sitesDesenvolvidos', type: 'array', items: new OA\Items(type: 'integer') ),
            ],
            type: 'object'
        )
    )]
    #[Route('', name: 'create', methods: ['POST'])]
    #[ACL\Api(enable: true, title: 'Criar', description: 'Criar Curriculo')]
    public function createAction(Request $request): Response
    {
        $this->validateAccess("createAction");

        if(!$request->getContent())
            return $this->json(['status' => false, 'message' => 'Dados inválidos!'], 400);

        /** Tranforma Corpo da requisação em um objeto da classe. */
        $object = $this->objectTransformer->JsonToObject( $this->getClass(), $request , [
            'nomeCompleto', 'email', 'telefone', 'dataNascimento', 'estado', 'cidade', 'estadoCivil', 'bairro', 'perfilFacebookInstagram', 'perfilLinkedin', 'comoConheceu', 'salarioAceitavel', 'salarioPretentido', 'tempoExperiencia1', 'tempoExperiencia2', 'mensagem', 'politicaPrivacidade', 'cargo1', 'cargo2', 'curriculo', 'objetivos', 'sitesDesenvolvidos', 
        ]);

        /** Valida Restrições do objeto */
        $errors = $this->validateConstraintErros($object);
        if($errors)
            return $this->json($errors);

        $em = $this->doctrine->getManager();
        $em->persist($object);
        $em->flush();

        $response = $this->objectTransformer->ObjectToJson( $object, [
            'id', 'nomeCompleto', 'email', 'telefone', 'dataNascimento', 'estado', 'cidade', 'estadoCivil', 'bairro', 'perfilFacebookInstagram', 'perfilLinkedin', 'comoConheceu', 'salarioAceitavel', 'salarioPretentido', 'tempoExperiencia1', 'tempoExperiencia2', 'mensagem', 'politicaPrivacidade', 'cargo1', 'cargo2', 'curriculo', 'objetivos', 'sitesDesenvolvidos', 
        ]);

        return $this->json($response, 201);
    }

    /** ****************************************************************************************** */
    /**
     * Recupera o recurso — Curriculo.
     * Recupera o recurso — Curriculo.
     */
    #[OA\Parameter( name: 'id', description: 'Identificador do recurso', in: 'path')]
    #[OA\Response(
        response: 200,
        description: 'Retorna recurso Curriculo',
        content: new OA\JsonContent(
            properties: [
                new OA\Property(property: 'id', type: 'integer'),
                new OA\Property(property: 'nomeCompleto', type: 'string'),
                new OA\Property(property: 'email', type: 'string'),
                new OA\Property(property: 'telefone', type: 'string'),
                new OA\Property(property: 'dataNascimento', type: 'string'),
                new OA\Property(property: 'estado', type: 'string'),
                new OA\Property(property: 'cidade', type: 'string'),
                new OA\Property(property: 'estadoCivil', type: 'string'),
                new OA\Property(property: 'bairro', type: 'string'),
                new OA\Property(property: 'perfilFacebookInstagram', type: 'string'),
                new OA\Property(property: 'perfilLinkedin', type: 'string'),
                new OA\Property(property: 'comoConheceu', type: 'string'),
                new OA\Property(property: 'salarioAceitavel', type: 'string'),
                new OA\Property(property: 'salarioPretentido', type: 'string'),
                new OA\Property(property: 'tempoExperiencia1', type: 'string'),
                new OA\Property(property: 'tempoExperiencia2', type: 'string'),
                new OA\Property(property: 'mensagem', type: 'string'),
                new OA\Property(property: 'politicaPrivacidade', type: 'boolean'),
                new OA\Property(property: 'cargo1', type: 'integer' ),
                new OA\Property(property: 'cargo2', type: 'integer' ),
                new OA\Property(property: 'curriculo', type: 'integer' ),
                new OA\Property(property: 'objetivos', type: 'array', items: new OA\Items(type: 'integer') ),
                new OA\Property(property: 'sitesDesenvolvidos', type: 'array', items: new OA\Items(type: 'integer') ),
            ],
            type: 'object'
        )
    )]
    #[OA\Response(response: 404, description: 'Recurso não encontrado')]
    #[Route('/{id}', name: 'show', methods: ['GET'])]
    #[ACL\Api(enable: true, title: 'Visualizar', description: 'Visualizar Curriculo')]
    public function showAction(Request $request, mixed $id): Response
    {
        $this->validateAccess("showAction");

        $object = $this->getRepository()->find($id);
        if (!$object)
            return $this->json(['status' => false, 'message' => 'Curriculo não encontrado!'], 404);

        $response = $this->objectTransformer->ObjectToJson( $object, [
            'id', 'nomeCompleto', 'email', 'telefone', 'dataNascimento', 'estado', 'cidade', 'estadoCivil', 'bairro', 'perfilFacebookInstagram', 'perfilLinkedin', 'comoConheceu', 'salarioAceitavel', 'salarioPretentido', 'tempoExperiencia1', 'tempoExperiencia2', 'mensagem', 'politicaPrivacidade', 'cargo1', 'cargo2', 'curriculo', 'objetivos', 'sitesDesenvolvidos', 
        ]);

        return $this->json($response);
    }

    /** ****************************************************************************************** */
    /**
     * Substitui o recurso — Curriculo.
     * Substitui o recurso — Curriculo.
     */
    #[OA\Parameter( name: 'id', description: 'Identificador do recurso', in: 'path')]
    #[OA\Response(
        response: 200,
        description: 'Retorna recurso Curriculo',
        content: new OA\JsonContent(
            properties: [
                new OA\Property(property: 'id', type: 'integer'),
                new OA\Property(property: 'nomeCompleto', type: 'string'),
                new OA\Property(property: 'email', type: 'string'),
                new OA\Property(property: 'telefone', type: 'string'),
                new OA\Property(property: 'dataNascimento', type: 'string'),
                new OA\Property(property: 'estado', type: 'string'),
                new OA\Property(property: 'cidade', type: 'string'),
                new OA\Property(property: 'estadoCivil', type: 'string'),
                new OA\Property(property: 'bairro', type: 'string'),
                new OA\Property(property: 'perfilFacebookInstagram', type: 'string'),
                new OA\Property(property: 'perfilLinkedin', type: 'string'),
                new OA\Property(property: 'comoConheceu', type: 'string'),
                new OA\Property(property: 'salarioAceitavel', type: 'string'),
                new OA\Property(property: 'salarioPretentido', type: 'string'),
                new OA\Property(property: 'tempoExperiencia1', type: 'string'),
                new OA\Property(property: 'tempoExperiencia2', type: 'string'),
                new OA\Property(property: 'mensagem', type: 'string'),
                new OA\Property(property: 'politicaPrivacidade', type: 'boolean'),
                new OA\Property(property: 'cargo1', type: 'integer' ),
                new OA\Property(property: 'cargo2', type: 'integer' ),
                new OA\Property(property: 'curriculo', type: 'integer' ),
                new OA\Property(property: 'objetivos', type: 'array', items: new OA\Items(type: 'integer') ),
                new OA\Property(property: 'sitesDesenvolvidos', type: 'array', items: new OA\Items(type: 'integer') ),
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
                new OA\Property(property: 'nomeCompleto', type: 'string'),
                new OA\Property(property: 'email', type: 'string'),
                new OA\Property(property: 'telefone', type: 'string'),
                new OA\Property(property: 'dataNascimento', type: 'string'),
                new OA\Property(property: 'estado', type: 'string'),
                new OA\Property(property: 'cidade', type: 'string'),
                new OA\Property(property: 'estadoCivil', type: 'string'),
                new OA\Property(property: 'bairro', type: 'string'),
                new OA\Property(property: 'perfilFacebookInstagram', type: 'string'),
                new OA\Property(property: 'perfilLinkedin', type: 'string'),
                new OA\Property(property: 'comoConheceu', type: 'string'),
                new OA\Property(property: 'salarioAceitavel', type: 'string'),
                new OA\Property(property: 'salarioPretentido', type: 'string'),
                new OA\Property(property: 'tempoExperiencia1', type: 'string'),
                new OA\Property(property: 'tempoExperiencia2', type: 'string'),
                new OA\Property(property: 'mensagem', type: 'string'),
                new OA\Property(property: 'politicaPrivacidade', type: 'boolean'),
                new OA\Property(property: 'cargo1', type: 'integer' ),
                new OA\Property(property: 'cargo2', type: 'integer' ),
                new OA\Property(property: 'curriculo', type: 'integer' ),
                new OA\Property(property: 'objetivos', type: 'array', items: new OA\Items(type: 'integer') ),
                new OA\Property(property: 'sitesDesenvolvidos', type: 'array', items: new OA\Items(type: 'integer') ),
            ],
            type: 'object'
        )
    )]
    #[Route('/{id}', name: 'edit', methods: ['PUT','PATCH'])]
    #[ACL\Api(enable: true, title: 'Editar', description: 'Editar Curriculo')]
    public function editAction(Request $request, mixed $id): Response
    {
        $this->validateAccess("editAction");

        $object = $this->getRepository()->find($id);
        if(!$object)
            return $this->json(['status' => false, 'message' => 'Curriculo não encontrado!'], 404);

        /** Transforma corpo da requisição em um objeto da classe. */
        $object = $this->objectTransformer->JsonToObject($object, $request, [
            'nomeCompleto', 'email', 'telefone', 'dataNascimento', 'estado', 'cidade', 'estadoCivil', 'bairro', 'perfilFacebookInstagram', 'perfilLinkedin', 'comoConheceu', 'salarioAceitavel', 'salarioPretentido', 'tempoExperiencia1', 'tempoExperiencia2', 'mensagem', 'politicaPrivacidade', 'cargo1', 'cargo2', 'curriculo', 'objetivos', 'sitesDesenvolvidos', 
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
            'id', 'nomeCompleto', 'email', 'telefone', 'dataNascimento', 'estado', 'cidade', 'estadoCivil', 'bairro', 'perfilFacebookInstagram', 'perfilLinkedin', 'comoConheceu', 'salarioAceitavel', 'salarioPretentido', 'tempoExperiencia1', 'tempoExperiencia2', 'mensagem', 'politicaPrivacidade', 'cargo1', 'cargo2', 'curriculo', 'objetivos', 'sitesDesenvolvidos', 
        ]);

        return $this->json($response);
    }

    /** ****************************************************************************************** */
    /**
    * Remove o recurso — Curriculo.
    * Remove o recurso — Curriculo.
    */
    #[OA\Parameter( name: 'id', description: 'Identificador do recurso', in: 'path')]
    #[OA\Response(response: 204, description: 'Recurso excluído')]
    #[OA\Response(response: 404, description: 'Recurso não encontrado')]
    #[Route('/{id}', name: 'delete', methods: ['DELETE'])]
    #[ACL\Api(enable: true, title: 'Deletar', description: 'Deletar Curriculo')]
    public function deleteAction(mixed $id): Response
    {
        $this->validateAccess("deleteAction");

        $object = $this->getRepository()->find($id);
        if (!$object)
            return $this->json(['status' => false, 'message' => 'Curriculo não encontrado.'], 404);

        $em = $this->doctrine->getManager();
        $em->remove($object);
        $em->flush();

        return $this->json(['status' => true, 'message' => 'Curriculo removido com sucesso.'], 204);
    }

}