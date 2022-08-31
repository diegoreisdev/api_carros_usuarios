<?php

declare(strict_types=1);

namespace App\Http\Controllers\V1\Cars;

use App\Http\Controllers\AbstractController;
use App\Services\Cars\CarsService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
/**
 * Class CarsController
 * @package App\Http\Controllers\V1\Cars
 */
class CarsController extends AbstractController
{
    /**
     * @param CarsService $service
     */
    public function __construct(CarsService $service)
    {
        parent::__construct($service);
    }

    /* MÉTODO RESPONSÁVEL EM RETORNAR TODOS OS CARROS DE 1 USUÁRIO 
    ****************************************************************************************/
    /**
     * @param Request $request
     * @param int $user
     * @return JsonResponse
     */
    public function findByUser(Request $request, int $user): JsonResponse
    {
        try {
            $limit = (int) $request->get('limit', 10);
            $result = $this->service->findByUser($user, $limit);

            $response = $this->successResponse($result, Response::HTTP_PARTIAL_CONTENT);
        } catch (Exception $e) {
            $response = $this->errorResponse($e);
        }

        return response()->json($response, $response['status_code']);
    }
}
