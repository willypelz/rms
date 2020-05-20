#!/bin/bash

BASE_PATH=/var/www
STAGING_PATH=${BASE_PATH}/staging
APP_PATH=${BASE_PATH}/rms

# sudo chown -R ec2-user:apache ${STAGING_PATH}

sudo chown -R ec2-user:apache ${APP_PATH}
sudo chmod 2775 ${APP_PATH}
find ${APP_PATH} -type d -exec sudo chmod 2775 {} \;
find ${APP_PATH} -type f -exec sudo chmod 0664 {} \;

#cp -R ${STAGING_PATH}/storage/. ${APP_PATH}/storage
#(cd ${STAGING_PATH}/storage; tar cf - .) | (cd ${APP_PATH}/storage; tar xvf -)

#cp -R ${STAGING_PATH}/public_html/uploads/. ${APP_PATH}/public_html/uploads
#(cd ${STAGING_PATH}/public_html/uploads; tar cf - .) | (cd ${APP_PATH}/public_html/uploads; tar xvf -)

#rm -rf ${STAGING_PATH}/storage ${STAGING_PATH}/public_html/uploads

#cp -R ${STAGING_PATH}/. ${APP_PATH}
#(cd ${STAGING_PATH}; tar cf - .) | (cd ${APP_PATH}; tar xvf -)