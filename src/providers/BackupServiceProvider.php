<?php

namespace Yousefpackage\LaraBackup\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use PDO;
class BackupServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        Config::set('database.connections.backup', [
            'driver' => 'mysql',
            'url' => env('DATABASE_URL'),
            'host' => env('BACKUP_DB_HOST', '127.0.0.1'),
            'port' => env('BACKUP_DB_PORT', '3306'),
            'database' => env('BACKUP_DB', 'forge'),
            'username' => env('BACKUP_DB_USERNAME', 'forge'),
            'password' => env('BACKUP_DB_PASSWORD', ''),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'prefix_indexes' => true,
            'strict' => true,
            'engine' => null,
        ]);

        DB::reconnect('backup');
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}