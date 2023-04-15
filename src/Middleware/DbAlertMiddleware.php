<?php

namespace Yousefpackage\LaraBackup\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yousefpackage\LaraBackup\Models\DbAlert;
use Illuminate\Support\Facades\DB;

class DbAlertMiddleware
{
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
        } catch (\Exception $e) {
            DB::reconnect('backup');
            DB::setDefaultConnection('backup');
            $alert = DbAlert::create([
                "alert" => $e->getMessage(),
            ]);
            return $next($request);
        }catch (\PDOException $ex) {
            DB::reconnect('backup');
            DB::setDefaultConnection('backup');
            $alert = DbAlert::create([
                "alert" => $ex->getMessage(),
            ]);
            return $next($request);
        }

    }
}
