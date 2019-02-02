#!/bin/bash
cd /application
service php7.2-fpm start
chown -Rf www-data:www-data /application

#create logs folder
mkdir --parents /application/storage/logs

chown -Rf www-data:www-data /application/storage/logs/
chmod -Rf 755 /application/storage/logs/

#install packages
composer install

#create .env file
cp -n .env.example .env

#generate laravel key
php /application/artisan key:generate

#clear config cache
php /application/artisan config:clear

tail -f /dev/stdout