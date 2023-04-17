<?php

namespace Yousefpackage\LaraBackup\Providers;
use Illuminate\Support\ServiceProvider;
use Yousefpackage\LaraBackup\Console\Commands\BackupCommand;
use Yousefpackage\LaraBackup\Console\Commands\AlertCommand;
class LaraBackupServiceProvider extends ServiceProvider{

    public function boot(){
        
        $this->loadRoutesFrom(__DIR__.'/../../routes/api.php');
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        if ($this->app->runningInConsole()) {
            $this->commands([
                BackupCommand::class,
                AlertCommand::class,
            ]);
        }
    }

    public function register(){

    }
}