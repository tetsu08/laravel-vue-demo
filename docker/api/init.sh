#!/bin/bash
composer install

cp .env.demo .env

php artisan migrate
php artisan key:generate
php artisan storage:link
php artisan config:cache
php artisan route:cache

chown www-data:www-data ./storage/ -R

npm install
npm run build