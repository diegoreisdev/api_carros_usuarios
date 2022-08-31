<?php

declare(strict_types=1);

namespace App\Services\Users;

use App\Services\AbstractService;

/**
 * Class UserService
 * @package App\Services\Users
 */
class UserService extends AbstractService
{
    /* MÉTODO RESPONSÁVEL EM CRIAR SENDO ENCRIPTADO
    ****************************************************************************************/
    /**
     * @param array $data
     * @return array
     */
    public function create(array $data): array
    {
        /* Encripitação da senha */
        $data['senha'] = encrypt($data['senha']);
        return $this->repository->create($data);
    }

    /* MÉTODO RESPONSÁVEL EM EDITAR UM REGISTRO SENDO ENCRIPTADO
    ****************************************************************************************/
    /**
     * @param int $id
     * @param array $data
     * @return bool
     */
    public function editBy(int $id, array $data): bool
    {
        /* Encripitação da senha */
        $data['senha'] = encrypt($data['senha']);
        return $this->repository->editBy($id, $data);
    }
}
