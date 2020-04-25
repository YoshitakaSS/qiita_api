php artisan key:generate
php artisan vendor:publish --provider="Barryvdh\Debugbar\ServiceProvider"

chmod -R 777 /var/www/qiita/bootstrap/cache
chmod -R 777 /var/www/qiita/storage