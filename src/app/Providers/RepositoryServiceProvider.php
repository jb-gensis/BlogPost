<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Services\Interfaces\BlogServiceInterface;
use App\Services\BlogService;

use App\Repositories\Interfaces\BlogRepositoryInterface;
use App\Repositories\BlogRepository;

use App\Services\Interfaces\AuthServiceInterface;
use App\Services\AuthService;

use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Repositories\UserRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            BlogServiceInterface::class,
            BlogService::class
        );

        $this->app->bind(
            BlogRepositoryInterface::class,
            BlogRepository::class
        );

        $this->app->bind(AuthServiceInterface::class, AuthService::class);

        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
    }
}
