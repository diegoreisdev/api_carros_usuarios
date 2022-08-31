<?php

declare(strict_types=1);

namespace App\Http\Controllers\V1\User;

use App\Http\Controllers\AbstractController;
use App\Services\Users\UserService;
/**
 * Class UserController
 * @package App\Http\Controllers\V1\User
 */
class UserController extends AbstractController
{
    /**
     * @param UserService $service
     */
    public function __construct(UserService $service)
    {
        parent::__construct($service);
    }
}
