web: composer run-script optimize-laravel-cmd && vendor/bin/heroku-php-apache2 public/
release: chmod -R 777 storage bootstrap/cache && php artisan migrate --force --seed && php artisan mmcms:seed
