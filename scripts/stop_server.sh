#!/bin/bash

PRODUCT="rms"
BASE_PATH=/var/www
CLIENT_APP_PATH=${BASE_PATH}/${PRODUCT}


/usr/local/bin/supervisorctl stop all

if [ ! $? -eq 0 ]; then #if this fails, start attempt to start supervisord

   service supervisord stop

fi