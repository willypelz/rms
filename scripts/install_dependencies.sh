#!/bin/bash

if ! [ -x "$(command -v jq)" ]; then 
yum install -y jq >&2;
fi # install jq if not installed

PRODUCT='hrms'
API_URL='https://master.seamlesshrms.com'

STAGING_DIR=/var/www/subdomains
APPSPEC_DEPLOY_PATH=${STAGING_DIR}/staging
mkdir -p ${STAGING_DIR}/${PRODUCT}
mkdir -p ${APPSPEC_DEPLOY_PATH}/public_html/uploads

BASE_PATH=/var/www/subdomains/${PRODUCT}
DEBUG_FILE=${BASE_PATH}/debug-deploy.log

touch ${DEBUG_FILE}

# Define a timestamp function
timestamp() {
  date +"%T"
}

echo "=== NEW DEPLOYMENT ===" >> ${DEBUG_FILE}
echo "$(timestamp): START CHMOD" >> ${DEBUG_FILE}

chmod -R 775 ${APPSPEC_DEPLOY_PATH}

echo "$(timestamp): DONE CHMOD" >> ${DEBUG_FILE}

echo "$(timestamp): START CHOWN" >> ${DEBUG_FILE}
chown -R ec2-user:apache ${APPSPEC_DEPLOY_PATH}

echo "$(timestamp): DONE CHOWN" >> ${DEBUG_FILE}

# LOOP THROUGH CLIENTS FOR THIS PRODUCT AND SETUP DIRECTORY STRUCTURE
CLIENTS_IN_PRODUCT=`cat ${BASE_PATH}/client-info.json | jq '.hrms'` # work in progress .hrms
for row in $(echo "${CLIENTS_IN_PRODUCT}" | jq -r '.[] | @base64'); do
    _jq() {
     echo ${row} | base64 --decode | jq -r ${1}
    }

    # loop through each client
    CLIENT_NAME=`echo $(_jq '.name')`
    GOBACK_DIR=`pwd`
    
    DEPLOY_PATH=${BASE_PATH}/${CLIENT_NAME}

    MOUNT_PATH=${BASE_PATH}/mnt/seamlesshr/${PRODUCT}
    
    APP_CLIENT_PATH=${MOUNT_PATH}/${CLIENT_NAME}
    APP_BUILD_PATH=${APP_CLIENT_PATH}/builds
    CURRENT_BUILD_PATH=${APP_BUILD_PATH}/build-`cat ${APPSPEC_DEPLOY_PATH}/version.txt`
    
    mkdir -p ${CURRENT_BUILD_PATH}
    #cp -r ${APPSPEC_DEPLOY_PATH}/. ${CURRENT_BUILD_PATH} >&2
    echo "$(timestamp): START TRANSFAR TO CURRENT BUILD DIR - ${CLIENT_NAME}" >> ${DEBUG_FILE}
    (cd ${APPSPEC_DEPLOY_PATH}; tar cf - .) | (cd ${CURRENT_BUILD_PATH}; tar xvf -) # faster alternative than cp
    echo "$(timestamp): FINISHED TRANSFAR TO CURRENT BUILD DIR - ${CLIENT_NAME}" >> ${DEBUG_FILE}
    

    mkdir -p ${APP_CLIENT_PATH}/storage
    
    echo "$(timestamp): START COPY STORAGE FOR - ${CLIENT_NAME}" >> ${DEBUG_FILE}
    (cd ${CURRENT_BUILD_PATH}/storage; tar cf - .) | (cd ${APP_CLIENT_PATH}/storage; tar xvf -)
    echo "$(timestamp): FINISH COPY STORAGE FOR - ${CLIENT_NAME}" >> ${DEBUG_FILE}
    
    rm -rf ${CURRENT_BUILD_PATH}/storage
    ln -sfn ${APP_CLIENT_PATH}/storage ${CURRENT_BUILD_PATH}/storage
    

    mkdir -p ${APP_CLIENT_PATH}/uploads
    
    echo "$(timestamp): START COPY UPLOADS FOR - ${CLIENT_NAME}" >> ${DEBUG_FILE}
    (cd ${CURRENT_BUILD_PATH}/public_html/uploads; tar cf - .) | (cd ${APP_CLIENT_PATH}/uploads; tar xvf -)
    echo "$(timestamp): FINISHED COPY UPLOADS FOR - ${CLIENT_NAME}" >> ${DEBUG_FILE}
    rm -rf ${CURRENT_BUILD_PATH}/public_html/uploads
    ln -sfn ${APP_CLIENT_PATH}/uploads ${CURRENT_BUILD_PATH}/public_html/uploads

    curl "${API_URL}"/api/get/client/env/"${CLIENT_NAME}"/"${PRODUCT}"  > "${APP_CLIENT_PATH}"/.env
    ln -sfn "${APP_CLIENT_PATH}"/.env ${CURRENT_BUILD_PATH}/.env

#prepare composer.json
# curl "${API_URL}"/api/get/skeleton/"${PRODUCT}" | jq '.' > "${CURRENT_BUILD_PATH}"/skeleton.json
# curl "${API_URL}"/api/get/client/packages/"${CLIENT_NAME}"/"${PRODUCT}" | jq '.' > "${CURRENT_BUILD_PATH}"/client-packages.json
# jq --argjson requiredPackages "$(<${CURRENT_BUILD_PATH}/client-packages.json)" '.require += $requiredPackages' "${CURRENT_BUILD_PATH}"/skeleton.json > "${CURRENT_BUILD_PATH}"/composer.json

# chown -R ec2-user:apache ${BASE_PATH}
# sudo find /var/www/ -type d -exec chmod 755 {} +
# sudo find /var/www/ -type f -exec chmod 644 {} +

    chmod -R 777 "${APP_CLIENT_PATH}"/storage

    chmod -R 777 "${CURRENT_BUILD_PATH}"/bootstrap/cache

# if ! [ -x "$(command -v composer)" ]; then
#   curl -sS https://getcomposer.org/installer | sudo php -- --install-dir=/usr/local/bin --filename=composer
#  export COMPOSER_HOME="$HOME/.config/composer";
#fi

# COMPOSER_MEMORY_LIMIT=-1 php /usr/local/bin/composer install -d "${CURRENT_BUILD_PATH}"
#php "${CURRENT_BUILD_PATH}" artisan migrate --seed --force


VHOST_FILE="${APP_CLIENT_PATH}"/${CLIENT_NAME}-vhost.conf
CLIENT_URL=${CLIENT_NAME}.seamlesshrms.com # will be gotten from api call, this is a placeholder


cat << EOF > "${VHOST_FILE}"
<VirtualHost *:80>
    ServerName ${CLIENT_URL}
    ServerAlias ${CLIENT_URL}
    ServerAdmin dayo@seamlesshr.com
    DocumentRoot ${DEPLOY_PATH}/public_html

    ErrorLog  ${DEPLOY_PATH}/storage/logs/error.log
    LogLevel warn
    CustomLog  ${DEPLOY_PATH}/storage/logs/access.log combined

     <Directory ${DEPLOY_PATH}>
        Options Indexes FollowSymLinks MultiViews
        AllowOverride All
        Order allow,deny
        allow from all
     </Directory>
</VirtualHost>
EOF

ln -sfn "${VHOST_FILE}" /etc/httpd/conf.d/${CLIENT_NAME}-vhost.conf

SUPERVISOR_FILE="${APP_CLIENT_PATH}"/${CLIENT_NAME}-supervisor.conf 
cat << EOF > "${SUPERVISOR_FILE}"
[program:${CLIENT_NAME}-worker]
process_name=%(program_name)s_%(process_num)02d
command=php ${DEPLOY_PATH}/artisan queue:work --sleep=3 --tries=1
autostart=true
autorestart=true
user=ec2-user # refactor
numprocs=5
redirect_stderr=true
stdout_logfile=${DEPLOY_PATH}/storage/logs/worker.log
EOF

ln -sfn "${SUPERVISOR_FILE}" /etc/supervisor/conf.d/${CLIENT_NAME}-worker.conf



ln -sfn ${CURRENT_BUILD_PATH} ${APP_CLIENT_PATH}/latest
# ln -sfn ${APP_CLIENT_PATH}/latest ${DEPLOY_PATH} ## handled in setup_script.sh



# clean up builds, leave latest 3
ls -d -1tr ${APP_BUILD_PATH}/build* | head -n -3 | xargs -d '\n' rm -rf --
    
    
    
    ### TEST CODE ###
    # curl "${API_URL}"/api/get/client/env/"${CLIENT_NAME}"/"${PRODUCT}"  > ${CLIENT_DIR}/.env
    # curl "${API_URL}"/api/get/skeleton/"${PRODUCT}" | jq '.' > ${CLIENT_DIR}/skeleton.json
    # curl "${API_URL}"/api/get/client/packages/"${CLIENT_NAME}"/"${PRODUCT}" | jq '.' > ${CLIENT_DIR}/client-packages.json
    # jq --argjson requiredPackages "$(<${CLIENT_DIR}/client-packages.json)" '.require += $requiredPackages' ${CLIENT_DIR}/skeleton.json > ${CLIENT_DIR}/composer.json
    
    # clean up
    # rm -rf ${CLIENT_DIR}/skeleton.json
    # rm -rf ${CLIENT_DIR}/client-packages.json

done

# rm -rf ${STAGING_DIR}/staging will be handled in setup_script.sh




#if [ "$(ls -A $DEPLOY_PATH)" ]; then
#     php "${DEPLOY_PATH}" artisan clear-compiled
#     php "${DEPLOY_PATH}" artisan view:clear
#     php "${DEPLOY_PATH}" artisan cache:clear
#fi



