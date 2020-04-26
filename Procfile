web: vendor/bin/heroku-php-apache2 public/
release: chmod -R 777 storage bootstrap/cache && php artisan migrate --force && php artisan db:seed --force && php artisan passport:keys
