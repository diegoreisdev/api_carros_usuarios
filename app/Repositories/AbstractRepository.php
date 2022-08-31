<?php

declare(strict_types=1);

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

/**
 * Class AbstractRepository
 * @package App\Repositories
 */
abstract class AbstractRepository implements RepositoryInterface
{
    /**
     * @var Model
     */
    protected Model $model;

    /**
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }
    
    /* MÉTODO RESPONSÁVEL EM CRIAR
    ****************************************************************************************/
    /**
     * @param array $data
     * @return array
     */
    public function create(array $data): array
    {
        return $this->model::create($data)->toArray();
    }

    /* MÉTODO RESPONSÁVEL EM EXIBIR OS REGISTROS
    ****************************************************************************************/
    /**
     * @param int $limit
     * @param array $orderBy     * 
     * @return array
     */
    public function findAll(int $limit = 10): array
    {

        $results = $this->model::query();

        return $results->paginate($limit)->appends([
            'limit'   => $limit
        ])->toArray();
    }

    /* MÉTODO RESPONSÁVEL EM EXIBIR UM REGISTRO
    ****************************************************************************************/
    /**
     * @param int $id
     * @return array
     */
    public function findOneBy(int $id): array
    {
        return $this->model::findOrFail($id)->toArray();
    }

    /* MÉTODO RESPONSÁVEL EM EDITAR UM REGISTRO
    ****************************************************************************************/
    /**
     * @param int $id
     * @param array $data
     * @return bool
     */
    public function editBy(int $id, array $data): bool
    {
        $result = $this->model::find($id)->update($data);
        return $result ? true : false;
    }

    /* MÉTODO RESPONSÁVEL EM EXCLUIR UM REGISTRO
    ****************************************************************************************/
    /**
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        return $this->model::destroy($id) ? true : false;
    }
}
