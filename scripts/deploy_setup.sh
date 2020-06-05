#!/bin/bash

BASE_PATH=/var/www
STAGING_PATH=${BASE_PATH}/staging
APP_PATH=${BASE_PATH}/rms

DEBUG_FILE=${APP_PATH}/storage/logs/debug-deploy.log
touch ${DEBUG_FILE}

# Define a timestamp function
timestamp() {
  date +"%Y-%m-%d %H:%M:%S"
}

echo '' > ${DEBUG_FILE} # erase old deployment info
echo "::::::: DEPLOY SETUP SCRIPT: [ $(timestamp) ]" >> ${DEBUG_FILE}

sudo chown -R ec2-user:apache ${STAGING_PATH}
sudo chmod 2775 ${STAGING_PATH}

rm -rf ${STAGING_PATH}/storage ${STAGING_PATH}/public_html/uploads ${STAGING_PATH}/vendor

cp -R ${STAGING_PATH}/. ${APP_PATH}/
rm -rf ${STAGING_PATH} ${APP_PATH}/composer.lock

echo "-- running composer: [ $(timestamp) ]" >> ${DEBUG_FILE}
php /usr/local/bin/composer install -d "${APP_PATH}" --no-interaction &>> ${DEBUG_FILE}
echo "-- running migration: [ $(timestamp) ]" >> ${DEBUG_FILE}
php "${APP_PATH}" artisan migrate --seed --force 2>> ${DEBUG_FILE}
