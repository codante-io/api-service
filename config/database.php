<?php

use Illuminate\Support\Str;

return [

    'default' => env('DB_CONNECTION', 'sqlite'),
    'connections' => [
        'sqlite' => [
            'driver' => 'sqlite',
            'database' => database_path('database.sqlite'),
            'foreign_key_constraints' => env('DB_FOREIGN_KEYS', true),
        ],

        'frases_motivacionais' => [
            'driver' => 'sqlite',
            'database' => database_path('db/frases_motivacionais.sqlite'),
            'foreign_key_constraints' => true,
        ],
        'orders' => [
            'driver' => 'sqlite',
            'database' => database_path('db/orders.sqlite'),
            'foreign_key_constraints' => true,
        ],
        'job_board' => [
            'driver' => 'sqlite',
            'database' => database_path('db/job_board.sqlite'),
            'foreign_key_constraints' => true,
        ],

    ],

    'migrations' => [
        'table' => 'migrations',
        'update_date_on_publish' => true,
    ],

    'redis' => [

        'client' => env('REDIS_CLIENT', 'phpredis'),

        'options' => [
            'cluster' => env('REDIS_CLUSTER', 'redis'),
            'prefix' => env('REDIS_PREFIX', Str::slug(env('APP_NAME', 'cdnt_apis_'), '_').'_database_'),
        ],

        'default' => [
            'url' => env('REDIS_URL'),
            'host' => env('REDIS_HOST', '127.0.0.1'),
            'username' => env('REDIS_USERNAME'),
            'password' => env('REDIS_PASSWORD'),
            'port' => env('REDIS_PORT', '6379'),
            'database' => env('REDIS_DB', '0'),
        ],

        'cache' => [
            'url' => env('REDIS_URL'),
            'host' => env('REDIS_HOST', '127.0.0.1'),
            'username' => env('REDIS_USERNAME'),
            'password' => env('REDIS_PASSWORD'),
            'port' => env('REDIS_PORT', '6379'),
            'database' => env('REDIS_CACHE_DB', '1'),
        ],

    ],

];
