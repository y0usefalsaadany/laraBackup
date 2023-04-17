<?php

namespace Yousefpackage\LaraBackup\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class AlertCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:alert';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'migrate all database with alerts table into backup database';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Artisan::call("migrate", ["--database" =>env('BACKUP_DB')]);
        $this->info(Artisan::output());
    }
}