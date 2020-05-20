#!/bin/bash

PRODUCT="rms"
BASE_PATH=/var/www
CLIENT_APP_PATH=${BASE_PATH}/${PRODUCT}

php /usr/local/bin/composer dumpautoload
php "${CLIENT_APP_PATH}"/artisan config:clear
php "${CLIENT_APP_PATH}"/artisan up

service httpd start