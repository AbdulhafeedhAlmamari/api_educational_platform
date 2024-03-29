<?php

namespace App\Providers;

use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Notifications\Messages\MailMessage;
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




        // VerifyEmail::toMailUsing(function ($notifiable, $url) {
        //     $spaUrl = "http://spa.test?email_verify_url=".$url;

        //     return (new MailMessage)
        //         ->subject('Verify Email Address')
        //         ->line('Click the button below to verify your email address.')
        //         ->action('Verify Email Address', $spaUrl);
        // });

        // Passport::ignoreRoutes();
        // Passport::routes();

        Passport::tokensCan([
            'user' => 'Access user endpoints',
            'student' => 'Access student endpoints',
            'admin' => 'Access admin endpoints',
            'teacher' => 'Access teacher endpoints',
        ]);
    }
}
