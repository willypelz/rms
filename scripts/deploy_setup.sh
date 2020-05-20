#!/bin/bash

BASE_PATH=/var/www
STAGING_PATH=${BASE_PATH}/staging
APP_PATH=${BASE_PATH}/rms

cp -R ${STAGING_PATH}/storage/. ${APP_PATH}/storage
#(cd ${STAGING_PATH}/storage; tar cf - .) | (cd ${APP_PATH}/storage; tar xvf -)

cp -R ${STAGING_PATH}/public_html/uploads/. ${APP_PATH}/public_html/uploads
#(cd ${STAGING_PATH}/public_html/uploads; tar cf - .) | (cd ${APP_PATH}/public_html/uploads; tar xvf -)

#rm -rf ${STAGING_PATH}/storage ${STAGING_PATH}/public_html/uploads

cp -R ${STAGING_PATH}/. ${APP_PATH}
#(cd ${STAGING_PATH}; tar cf - .) | (cd ${APP_PATH}; tar xvf -)