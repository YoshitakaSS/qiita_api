# First Process Before Docker Comopose Build

## create network

```bash
docker network create qiita
```

### To Use Laravel Project

#### laravel-debugbar

If the following files are not created

/config/debugbar.php
/vendor/barryvdh/laravel-debugbar/config/debugbar.php


```bash
php artisan vendor:publish --provider="Barryvdh\Debugbar\ServiceProvider"
```

add text line in config/app.php

```php

    'providers' => [
+       Barryvdh\Debugbar\ServiceProvider::class, # providersの中に追加
    ],
    'aliases' => [
+       'Debugbar' => Barryvdh\Debugbar\Facade::class, # aliasesの中に追加
    ],
```


add true/false in .env of laravel project

```bash
# for dev
DEBUGBAR_ENABLED=true
# for prd
DEBUGBAR_ENABLED=false
```

