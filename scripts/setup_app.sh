#!/bin/bash

PRODUCT='hrms'
BASE_PATH=/var/www/subdomains

# LOOP THROUGH CLIENTS FOR THIS PRODUCT AND SETUP DIRECTORY STRUCTURE
CLIENTS_IN_PRODUCT=`cat ${BASE_PATH}/${PRODUCT}/client-info.json | jq '.hrms'` # work in progress .hrms

for row in $(echo "${CLIENTS_IN_PRODUCT}" | jq -r '.[] | @base64'); do
    _jq() {
     echo ${row} | base64 --decode | jq -r ${1}
    }
    
    # loop through each client
    CLIENT_NAME=`echo $(_jq '.name')`
    
    DEPLOY_PATH=${BASE_PATH}/${PRODUCT}/${CLIENT_NAME}
    MOUNT_PATH=${BASE_PATH}/${PRODUCT}/mnt/seamlesshr/${PRODUCT}
    
    APPSPEC_DEPLOY_PATH=${BASE_PATH}/staging
    APP_CLIENT_PATH=${MOUNT_PATH}/${CLIENT_NAME}
    APP_BUILD_PATH=${APP_CLIENT_PATH}/builds
    CURRENT_BUILD_PATH=${APP_BUILD_PATH}/build-`cat ${APPSPEC_DEPLOY_PATH}/version.txt`

    # remove composer.lock if it exists
    # if [[ -f "${CURRENT_BUILD_PATH}/composer.lock" ]]
    # then
    #     rm "${CURRENT_BUILD_PATH}"/composer.lock
    # fi
    
    # if [[ "$(ls -A ${DEPLOY_PATH})" && ! -L "${DEPLOY_PATH}" ]]; then
    #    rm -rf ${DEPLOY_PATH}
    # fi

    ln -sfn ${APP_CLIENT_PATH}/latest/ ${DEPLOY_PATH}


done

rm -rf ${BASE_PATH}/staging

#COMPOSER_MEMORY_LIMIT=-1 composer.phar install -d "${APP_BUILD_PATH}"

#php "${APP_BUILD_PATH}"/artisan migrate --seed --force

# move active client active folder if its not empty
#if [ "$(ls -A ${DEPLOY_PATH})" ]; then
#     cp -R "${DEPLOY_PATH}"/. "${DEPLOY_PATH}".old
#fi



# commented out since we didnt run composer
#php "${DEPLOY_PATH}"/artisan up