<?php

namespace Yousefpackage\LaraBackup\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class BackupCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:backup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $banner = <<<banner
        _                _                  
        | |__   __ _  ___| | ___   _ _ __    
        | '_ \ / _` |/ __| |/ / | | | '_ \   
        | |_) | (_| | (__|   <| |_| | |_) |  
        |_.__/ \__,_|\___|_|\_\\__,_| .__/   
                                    |_|  
        banner;
        echo $banner;
        Artisan::call("migrate", ["--database" =>env('BACKUP_DB')]);
        $this->info(Artisan::output());
    }
}