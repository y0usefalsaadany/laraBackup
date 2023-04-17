<?php

namespace Yousefpackage\LaraBackup\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yousefpackage\LaraBackup\Models\DbAlert;
use Illuminate\Support\Facades\DB;
class DbAlertMiddleware
{
    protected static $visitNumber=0;
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        
            try {
                DB::connection()->getPdo();
                return $next($request);
            } catch (\Exception | \PDOException $e) {
                DB::reconnect(env('BACKUP_DB'));
                DB::setDefaultConnection(env('BACKUP_DB'));
                $alert = DbAlert::create([
                    "alert" => $e->getMessage(),
                ]);
                return $next($request);
            }
    }

    public function terminate(Request $request, Response $response)
    {
        self::$visitNumber++;
        if(self::$visitNumber == 2){
            //
        }else{
            DB::setDefaultConnection(env('BACKUP_DB')); 
            $response = app()->handle($request);
            return $response;
        }
    }
}