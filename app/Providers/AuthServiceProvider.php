<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        'App\Models' => 'App\Policies\ModelPolicy',
    ];

    public function boot()
    {
        $this->registerPolicies();

        // Passport::ignoreRoutes();
        // Passport::routes();

        Passport::tokensCan([
            'student' => 'Access student endpoints',
            'admin' => 'Access admin endpoints',
            'teacher' => 'Access teacher endpoints',
        ]);
    }
}
