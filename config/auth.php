<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Authentication Defaults
    |--------------------------------------------------------------------------
    |
    | This option controls the default authentication "guard" and password
    | reset options for your application. You may change these defaults
    | as required, but they're a perfect start for most applications.
    |
    */

    'defaults' => [
        'guard' => 'web',
        'passwords' => 'users',
    ],

    /*
    |--------------------------------------------------------------------------
    | Authentication Guards
    |--------------------------------------------------------------------------
    |
    | Next, you may define every authentication guard for your application.
    | Of course, a great default configuration has been defined for you
    | here which uses session storage and the Eloquent user provider.
    |
    | All authentication drivers have a user provider. This defines how the
    | users are actually retrieved out of your database or other storage
    | mechanisms used by this application to persist your user's data.
    |
    | Supported: "session"
    |
    */

    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'users',
        ],
        'user' => [
            'driver' => 'session',
            'provider' => 'users',
        ],
        // 'user' => [
        //     'driver' => 'passport',
        //     'provider' => 'users',
        // ],

        // for student
        'student' => [
            'driver' => 'session',
            'provider' => 'students',
        ],

        'student_api' => [
            'driver' => 'passport',
            'provider' => 'students',
        ],

        // for teacher
        'teacher' => [
            'driver' => 'session',
            'provider' => 'teachers',
        ],

        'teacher_api' => [
            'driver' => 'passport',
            'provider' => 'teachers',
        ],

        // for admin
        'admin' => [
            'driver' => 'session',
            'provider' => 'admins',
        ],

        'admin_api' => [
            'driver' => 'passport',
            'provider' => 'admins',
        ],


        // 'student' => [
        //     'driver' => 'session',
        //     'provider' => 'students',
        // ],
        // 'api' => [
        //     'driver' => 'passport',
        //     'provider' => 'users',
        // ],
        'user_api' => [
            'driver' => 'passport',
            'provider' => 'users',
        ],
        // 'student_api' => [
        //     'driver' => 'passport',
        //     'provider' => 'students',
        // ],
    ],

    /*
    |--------------------------------------------------------------------------
    | User Providers
    |--------------------------------------------------------------------------
    |
    | All authentication drivers have a user provider. This defines how the
    | users are actually retrieved out of your database or other storage
    | mechanisms used by this application to persist your user's data.
    |
    | If you have multiple user tables or models you may configure multiple
    | sources which represent each model / table. These sources may then
    | be assigned to any extra authentication guards you have defined.
    |
    | Supported: "database", "eloquent"
    |
    */

    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => App\Models\User::class,
        ],


        // for student
        'students' => [
            'driver' => 'eloquent',
            'model' => App\Models\Student::class,
        ],

        // for teacher
        'teachers' => [
            'driver' => 'eloquent',
            'model' => App\Models\Teacher::class,
        ],

        // for admin
        'admins' => [
            'driver' => 'eloquent',
            'model' => App\Models\Admin::class,
        ],



        // 'users' => [
        //     'driver' => 'database',
        //     'table' => 'users',
        // ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Resetting Passwords
    |--------------------------------------------------------------------------
    |
    | You may specify multiple password reset configurations if you have more
    | than one user table or model in the application and you want to have
    | separate password reset settings based on the specific user types.
    |
    | The expiry time is the number of minutes that each reset token will be
    | considered valid. This security feature keeps tokens short-lived so
    | they have less time to be guessed. You may change this as needed.
    |
    | The throttle setting is the number of seconds a user must wait before
    | generating more password reset tokens. This prevents the user from
    | quickly generating a very large amount of password reset tokens.
    |
    */

    'passwords' => [
        'users' => [
            'provider' => 'users',
            'table' => 'password_reset_tokens',
            'expire' => 60,
            'throttle' => 60,
        ],

        // for student
        'students' => [
            'provider' => 'students',
            'table' => 'student_password_reset_tokens',
            'expire' => 60,
            'throttle' => 60,
        ],

        // for teacher
        'teachers' => [
            'provider' => 'teachers',
            'table' => 'teacher_password_reset_tokens',
            'expire' => 60,
            'throttle' => 60,
        ],

        // for admin
        'admins' => [
            'provider' => 'admins',
            'table' => 'admin_password_reset_tokens',
            'expire' => 60,
            'throttle' => 60,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Password Confirmation Timeout
    |--------------------------------------------------------------------------
    |
    | Here you may define the amount of seconds before a password confirmation
    | times out and the user is prompted to re-enter their password via the
    | confirmation screen. By default, the timeout lasts for three hours.
    |
    */

    'password_timeout' => 10800,

];

// 'guards' => [
//     'student' => [
//         'driver' => 'passport',
//         'provider' => 'students',
//     ],

//     'admin' => [
//         'driver' => 'passport',
//         'provider' => 'admins',
//     ],

//     'teacher' => [
//         'driver' => 'passport',
//         'provider' => 'teachers',
//     ],
// ],

// 'providers' => [
//     'students' => [
//         'driver' => 'eloquent',
//         'model' => App\Models\Student::class,
//     ],

//     'admins' => [
//         'driver' => 'eloquent',
//         'model' => App\Models\Admin::class,
//     ],

//     'teachers' => [
//         'driver' => 'eloquent',
//         'model' => App\Models\Teacher::class,
//     ],
// ],

// 'passwords' => [
//     'students' => [
//         'provider' => 'students',
//         'table' => 'password_resets',
//         'expire' => 60,
//         'throttle' => 60,
//     ],

//     'admins' => [
//         'provider' => 'admins',
//         'table' => 'password_resets',
//         'expire' => 60,
//         'throttle' => 60,
//     ],

//     'teachers' => [
//         'provider' => 'teachers',
//         'table' => 'password_resets',
//         'expire' => 60,
//         'throttle' => 60,
//     ],
// ],
