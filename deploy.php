<?php

namespace Deployer;

require 'recipe/laravel.php';

// Config

set('repository', 'git@github.com:codante-io/api-service.git');

add('shared_files', []);
add('shared_dirs', ['database/db']);
add('writable_dirs', ['database/db']);
set('keep_releases', 1);

// Tasks
// run artisan command
task('api-commands', function () {
    run('{{bin/php}} {{release_path}}/artisan api:orders-api:reset');
    run('{{bin/php}} {{release_path}}/artisan api:frases-motivacionais:reset');
    run('{{bin/php}} {{release_path}}/artisan migrate --database="olympic_games" --path="database/migrations/olympic_games"');
})->desc('Reset orders');

// Hosts
host('216.238.108.237')
    ->set('remote_user', 'robertotcestari')
    ->set('deploy_path', '/var/www/apis');

// Hooks
after('artisan:migrate', 'api-commands');
after('deploy:failed', 'deploy:unlock');
