<?php

return [
    'defaults' => [
        'guard' => 'api',
        'password' => 'users',
    ],

    'guards' => [
        'web' => [
            'driver' => 'jwt',
            'provider' => 'users'
        ],
        'api' => [
            'driver' => 'jwt',
            'provider' => 'users',
        ],
    ],

    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => App\Models\User::class
        ]
    ]
];