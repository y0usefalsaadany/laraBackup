<?php

use Illuminate\Support\Facades\Route;
use Yousefpackage\LaraBackup\Models\DbAlert;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/dbAlerts', function () {
    DB::reconnect('backup');
    DB::setDefaultConnection('backup');
    $alerts = DbAlert::get();
    return response()->json($alerts);
});