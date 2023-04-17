<?php

namespace Yousefpackage\LaraBackup\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

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
    protected $description = 'database backup alerts';

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
        Artisan::call('db:wipe', ["--database" =>env('BACKUP_DB')]);
        $this->info(Artisan::output());
        Artisan::call("migrate", ["--database" =>env('BACKUP_DB')]);
        $this->info(Artisan::output());
        $tables = DB::connection(env('DB_CONNECTION'))->select('SHOW TABLES');
        foreach($tables as $table)
        {
            foreach ($table as $key => $value){
                
                $data = DB::select("select * from $value");
                DB::setDefaultConnection(env('BACKUP_DB')); 

                DB::table($value)->insert($data);
            }   
        }
    }
}