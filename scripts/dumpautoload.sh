#!/bin/bash

PRODUCT="rms"
BASE_PATH=/var/www
CLIENT_APP_PATH=${BASE_PATH}/${PRODUCT}

cd "${CLIENT_APP_PATH}"
php /usr/local/bin/composer dumpautoload