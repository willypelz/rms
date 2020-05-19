#!/bin/bash

PRODUCT="rms"
BASE_PATH=/var/www
CLIENT_APP_PATH=${BASE_PATH}/${PRODUCT}

php "${CLIENT_APP_PATH}"/artisan down

service httpd stop