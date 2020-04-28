# First Process Before Docker Comopose Build

1. create network

```bash
docker network create qiita
```
2. build

```bash
docker-compose up -d
```

3. After build. Checking the running container

```bash
$ docker ps

CONTAINER ID        IMAGE               COMMAND                  CREATED             STATUS              PORTS                                         NAMES
698c65c311fc        qiita_qiita_nginx   "/usr/sbin/nginx -g …"   18 hours ago        Up 18 hours         80/tcp, 0.0.0.0:9000->90/tcp                  qiita_nginx
d74014ba024f        qiita_qiita_php     "docker-php-entrypoi…"   18 hours ago        Up 18 hours         9000/tcp                                      qiita_php
ff200aa14178        d6c4677d678a        "python3"                18 hours ago        Up 18 hours                                                       python_batch
2c63d1243a70        mysql:5.7           "docker-entrypoint.s…"   18 hours ago        Up 18 hours         3306/tcp, 33060/tcp, 0.0.0.0:4306->4306/tcp   qiita_db
```

### To Use Laravel Project

#### ◆laravel-debugbar

If the following files are not created

- /config/debugbar.php
- /vendor/barryvdh/laravel-debugbar/config/debugbar.php


```bash
php artisan vendor:publish --provider="Barryvdh\Debugbar\ServiceProvider"
```

add text line in config/app.php

```php

    'providers' => [
+       Barryvdh\Debugbar\ServiceProvider::class,
    ],
    'aliases' => [
+       'Debugbar' => Barryvdh\Debugbar\Facade::class,
    ],
```


add true/false in **.env** of laravel project

```bash
# for dev
DEBUGBAR_ENABLED=true
# for prd
DEBUGBAR_ENABLED=false
```

