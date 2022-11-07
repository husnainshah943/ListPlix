<?php

namespace App\Providers;

use App\Repository\AuthRepository;
use App\Repository\Interfaces\AuthInterface;
use App\Repository\Interfaces\ProjectInterface;
use App\Repository\Interfaces\TaskListInterface;
use App\Repository\Interfaces\UserProfileInterface;
use App\Repository\ProjectRepository;
use App\Repository\TaskListRepository;
use App\Repository\UserProfileRepository;
use App\Repository\WebApi\Interfaces\WebAuthInterface;
use App\Repository\WebApi\Interfaces\WebUserProfileInterface;
use App\Repository\WebApi\WebAuthRepository;
use App\Repository\WebApi\WebUserProfileRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(AuthInterface::class, AuthRepository::class);
        $this->app->bind(UserProfileInterface::class, UserProfileRepository::class);
        $this->app->bind(ProjectInterface::class, ProjectRepository::class);
        $this->app->bind(TaskListInterface::class, TaskListRepository::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
