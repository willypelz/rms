#!/bin/bash

PRODUCT="rms"
BASE_PATH=/var/www
CLIENT_APP_PATH=${BASE_PATH}/${PRODUCT}

cd "${CLIENT_APP_PATH}"

php artisan config:clear
php artisan up

/usr/local/bin/supervisorctl start all

if [ ! $? -eq 0 ]; then #if this fails, start attempt to start supervisord
    service supervisord start
fi