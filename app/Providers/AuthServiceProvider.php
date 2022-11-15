<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
<<<<<<< HEAD
=======
use Laravel\Passport\Passport;
>>>>>>> e8082a1 (ListPlix Completed - RestApis)

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
<<<<<<< HEAD

        //
    }
}
=======
        Passport::tokensCan([
            'admin' => 'For Admin',
            'user' => 'For User',
        ]);
        //
    }
}
>>>>>>> e8082a1 (ListPlix Completed - RestApis)
