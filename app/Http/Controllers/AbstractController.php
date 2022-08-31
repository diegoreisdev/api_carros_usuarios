<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Services\ServiceInterface;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Laravel\Lumen\Routing\Controller as BaseController;

/**
 * Class AbstractController
 * @package App\Http\Controllers
 */
abstract class AbstractController extends BaseController implements ControllerInterface
{
    /**
     * @var ServiceInterface
     */
    protected ServiceInterface $service;

    /**
     * AbstractController constructor
     * @param ServiceInterface $service
     */
    public function __construct(ServiceInterface $service)
    {
        $this->service = $service;
    }

    /* MÉTODO RESPONSÁVEL EM CRIAR
    ****************************************************************************************/
    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function create(Request $request): JsonResponse
    {
        try {
            $result = $this->service->create($request->all());
            $response = $this->successResponse($result, Response::HTTP_CREATED);
        } catch (Exception $e) {
            $response = $this->errorResponse($e);
        }

        return response()->json($response, $response['status_code']);
    }

    /* MÉTODO RESPONSÁVEL EM EXIBIR OS REGISTROS
    ****************************************************************************************/
    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function findAll(Request $request): JsonResponse
    {
        try {
            $limit = (int) $request->get('limit', 10);

            $result = $this->service->findAll($limit);
            $response = $this->successResponse($result, Response::HTTP_PARTIAL_CONTENT);
        } catch (Exception $e) {
            $response = $this->errorResponse($e);
        }

        return response()->json($response, $response['status_code']);
    }

    /* MÉTODO RESPONSÁVEL EM EXIBIR UM REGISTRO
    ****************************************************************************************/
    /**
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     */
    public function findOneBy(Request $request, int $id): JsonResponse
    {
        try {
            $result = $this->service->findOneBy($id);
            $response = $this->successResponse($result);
        } catch (Exception $e) {
            $response = $this->errorResponse($e);
        }

        return response()->json($response, $response['status_code']);
    }

    /* MÉTODO RESPONSÁVEL EM EDITAR UM REGISTRO
    ****************************************************************************************/
    /**
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     */
    public function editBy(Request $request, int $id): JsonResponse
    {
        try {
            $result['registro_alterado'] = $this->service->editBy($id, $request->all());
            $response = $this->successResponse($result);
        } catch (Exception $e) {
            $response = $this->errorResponse($e);
        }

        return response()->json($response, $response['status_code']);
    }

    /* MÉTODO RESPONSÁVEL EM EXCLUIR O RESGISTRO
    ****************************************************************************************/
    /**
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     */
    public function delete(Request $request, int $id): JsonResponse
    {
        try {
            $result['registro_deletado'] = $this->service->delete($id);
            $response = $this->successResponse($result);
        } catch (Exception $e) {
            $response = $this->errorResponse($e);
        }

        return response()->json($response, $response['status_code']);
    }

    /* MÉTODO RESPONSÁVEL EM RETORNAR SUCESSO
    ****************************************************************************************/
    /**
     * @param array $data
     * @param int $statusCode
     * @return array
     */
    protected function successResponse(array $data, int $statusCode = Response::HTTP_OK): array
    {
        return [
            'status_code' => $statusCode,
            'data'        => $data
        ];
    }

    /* MÉTODO RESPONSÁVEL EM RETORNAR ERRO
    ****************************************************************************************/
    /**
     * @param Exception $e
     * @param int $statusCode
     * @return array
     */
    protected function errorResponse(Exception $e, int $statusCode = Response::HTTP_BAD_REQUEST): array
    {
        return [
            'status_code'       => $statusCode,
            'error'             => true,
            'error_description' => $e->getMessage()
        ];
    }
}
