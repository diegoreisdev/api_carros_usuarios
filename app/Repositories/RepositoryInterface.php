<?php

declare(strict_types=1);

namespace App\Repositories;

/**
 * Interface RepositoryInterface
 * @package App\Repositories
 */
interface RepositoryInterface
{

    /**
     * @param array $data
     * @return array
     */
    public function create(array $data): array;

    /**
     * @param int $limit
     * @return array
     */
    public function findAll(int $limit = 10): array;

    /**
     * @param int $id
     * @return array
     */
    public function findOneBy(int $id): array;

    /**
     * @param int $id
     * @param array $data
     * @return bool
     */
    public function editBy(int $id, array $data): bool;

    /**
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool;
}
