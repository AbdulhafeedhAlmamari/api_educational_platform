<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
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

    public function boot(): void
    {
        $this->registerPolicies();

        // Passport::ignoreRoutes();
        // Passport::tokensCan([
        //     'student' => 'Access student endpoints',
        //     'admin' => 'Access admin endpoints',
        //     'teacher' => 'Access teacher endpoints',
        // ]);
        // Passport::ignoreRoutes();
        Passport::tokensCan([
            'user_api' => 'User Type',
            'student_api' => 'Access student endpoints',
        ]);
    }
}
