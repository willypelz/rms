#!/bin/bash

BASE_PATH=/var/www
STAGING_PATH=${BASE_PATH}/staging
APP_PATH=${BASE_PATH}/rms

(cd ${STAGING_PATH}/storage; tar cf - .) | (cd ${APP_PATH}/storage; tar xvf -)

(cd ${STAGING_PATH}/public_html/uploads; tar cf - .) | (cd ${APP_PATH}/public_html/uploads; tar xvf -)

rm -rf ${STAGING_PATH}/storage ${STAGING_PATH}/public_html/uploads

(cd ${STAGING_PATH}; tar cf - .) | (cd ${APP_PATH}; tar xvf -)