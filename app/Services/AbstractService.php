<?php

declare(strict_types=1);

namespace App\Services;

use App\Repositories\RepositoryInterface;

/**
 * Class AbstractService
 * @package App\Services
 */
abstract class AbstractService implements ServiceInterface
{
    /**
     * @var RepositoryInterface
     */
    protected RepositoryInterface $repository;

    /**
     * AbstractService constructor
     * @param RepositoryInterface $repository
     */
    public function __construct(RepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /* MÉTODO RESPONSÁVEL EM CRIAR
    ****************************************************************************************/
    /**
     * @param array $data
     * @return array
     */
    public function create(array $data): array
    {
        return $this->repository->create($data);
    }

    /* MÉTODO RESPONSÁVEL EM EXIBIR OS REGISTROS
    ****************************************************************************************/
    /**
     * @param int $limit
     * @return array
     */
    public function findAll(int $limit = 10): array
    {
        return $this->repository->findAll($limit);
    }

    /* MÉTODO RESPONSÁVEL EM EXIBIR UM REGISTRO
    ****************************************************************************************/
    /**
     * @param int $id
     * @return array
     */
    public function findOneBy(int $id): array
    {
        return $this->repository->findOneBy($id);
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
        return $this->repository->editBy($id, $data);
    }

    /* MÉTODO RESPONSÁVEL EM EXCLUIR UM REGISTRO
    ****************************************************************************************/
    /**
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        return $this->repository->delete($id);
    }
}
