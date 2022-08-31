<?php

declare(strict_types=1);

namespace App\Services\Cars;

use App\Services\AbstractService;

/**
 * Class CarsService
 * @package App\Services\Cars
 */
class CarsService extends AbstractService
{
    /* MÉTODO RESPONSÁVEL EM RETORNAR TODOS OS CARROS DE 1 USUÁRIO 
    ****************************************************************************************/
    /**
     * @param int $usuarioId
     * @param int $limit
     * @return array
     */
    public function findByUser(int $usuarioId, int $limit = 10): array
    {
        return $this->repository->findByUser($usuarioId, $limit);
    }
}
