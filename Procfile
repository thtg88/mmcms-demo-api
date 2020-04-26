web: vendor/bin/heroku-php-apache2 public/
release: php artisan passport:keys && chmod -R 777 storage bootstrap/cache && php artisan migrate --force && php artisan db:seed --force
