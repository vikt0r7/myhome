<?php
namespace Deployer;

require 'recipe/laravel.php';

// Project name
set('application', 'MyHome apartments');

// Project repository
set('repository', 'git@github.com:vikt0r7/myhome.git');

// [Optional] Allocate tty for git clone. Default value is false.
set('git_tty', true);

set('testing', 'prod');

// Shared files/dirs between deploys
add('shared_files', []);
add('shared_dirs', []);

// Writable dirs by web server
add('writable_dirs', []);


// Hosts
host('prod')
    ->hostname('example.com')
    ->set('testing', 'prod')
    ->set('deploy_path', '~/{{application}}');

// Tasks

task('build', function () {
    run('cd {{release_path}} && build');
});

// [Optional] if deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');

// Migrate database before symlink new release.

before('deploy:symlink', 'artisan:migrate');

