#!/bin/bash

PRODUCT="rms"
BASE_PATH=/var/www
CLIENTS_IN_PRODUCT=`cat ${BASE_PATH}/client-info.json | jq '.hrms'` # work in progress .hrms

for row in $(echo "${CLIENTS_IN_PRODUCT}" | jq -r '.[] | @base64'); do
    _jq() {
     echo ${row} | base64 --decode | jq -r ${1}
    }
    
    # loop through each client
    CLIENT_NAME=`echo $(_jq '.name')`
	CLIENT_APP_PATH=${BASE_PATH}/${PRODUCT}/${CLIENT_NAME}

	php "${CLIENT_APP_PATH}"/artisan down
	
done

service httpd stop