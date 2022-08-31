<?php

declare(strict_types=1);

namespace App\Providers;

use App\Models\User\User;
use App\Repositories\Users\UserRepository;
use App\Services\Users\UserService;
use Illuminate\Support\ServiceProvider;

class UserServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(UserService::class, function($app) {
            return new UserService(new UserRepository(new User()));
        });
    }
}