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
        'bloquinhos2025' => [
            'driver' => 'sqlite',
            'database' => database_path('db/bloquinhos2025.sqlite'),
            'foreign_key_constraints' => true,
        ],
        'olympic_games' => [
            'driver' => 'sqlite',
            'database' => database_path('db/olympic_games.sqlite'),
            'foreign_key_constraints' => true,
        ],
        'legado_feminino' => [
            'driver' => 'sqlite',
            'database' => database_path('db/legado_feminino.sqlite'),
            'foreign_key_constraints' => true,
        ],
        'senator_expenses' => [
            'driver' => 'mysql',
            'database' => 'apis-senator-expenses',
            'host' => env('DB_HOST', '127.0.0.1'),
            'port' => env('DB_PORT', '3306'),
            'username' => env('DB_USERNAME'),
            'password' => env('DB_PASSWORD'),
            'foreign_key_constraints' => true,
        ],
        'reviews' => [
            'driver' => 'sqlite',
            'database' => database_path('db/reviews.sqlite'),
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
