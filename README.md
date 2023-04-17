# install package

```
composer require yousefpackage/lara-backup
```

# then goto config folder 

in config/app.php


```
'providers' => [

Yousefpackage\LaraBackup\Providers\LaraBackupServiceProvider::class,
Yousefpackage\LaraBackup\Providers\BackupServiceProvider::class,
Yousefpackage\LaraBackup\Providers\RouteServiceProvider::class,

],
```

# then goto kernel.php

write this in $routeMiddleware

```
'DbBackup'=>\Yousefpackage\LaraBackup\Middleware\DbAlertMiddleware::class,
```

# then goto env file and put this

```
BACKUP_DB_HOST=127.0.0.1
BACKUP_DB_PORT=3306
BACKUP_DB=backup
BACKUP_DB_USERNAME=root
BACKUP_DB_PASSWORD=
```

# then run this command 

```
php artisan db:alert
```



# using
Now Put this middleware on the route you want to calculate the number of views for.

```
->middleware('DbBackup');
```

like this 

```
Route::get('/data', function () {
    return response()->json('data');
})->middleware('DbBackup');
```

# get database alerts 

now to get database backup database alerts  using this api 

```
http://127.0.0.1:8000/api/dbAlerts