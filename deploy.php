<?php
namespace Deployer;

require 'recipe/laravel.php';

// Config

set('repository', 'git@github.com:codante-io/api-service.git');

add('shared_files', []);
add('shared_dirs', []);
add('writable_dirs', []);
set("keep_releases", 1);


// Hosts

host('216.238.108.237')
    ->set('remote_user', 'robertotcestari')
    ->set('deploy_path', '/var/www/apis');

// Hooks

after('deploy:failed', 'deploy:unlock');
