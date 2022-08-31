<?php

declare(strict_types=1);

namespace App\Repositories\Cars;

use App\Repositories\AbstractRepository;

/**
 * Class CarsRepository
 * @package App\Repositories\Cars
 */
class CarsRepository extends AbstractRepository
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
        $results = $this->model::where('usuario_id', $usuarioId);

        return $results->paginate($limit)->appends([
            'limit'    => $limit
        ])->toArray();
    }
}
