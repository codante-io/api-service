<?php
namespace Deployer;

require 'recipe/laravel.php';

// Config

set('repository', 'git@github.com:codante-io/api-service.git');

add('shared_files', []);
add('shared_dirs', []);
add('writable_dirs', []);
set("keep_releases", 1);

// Tasks
// run artisan command
task('artisan:api:orders:reset', function () {
    run('{{bin/php}} {{release_path}}/artisan api:orders:reset');
})->desc('Reset orders');


// Hosts

host('216.238.108.237')
    ->set('remote_user', 'robertotcestari')
    ->set('deploy_path', '/var/www/apis');

// Hooks
after('artisan:migrate', 'artisan:api:orders:reset');
after('deploy:failed', 'deploy:unlock');
