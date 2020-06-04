#!/bin/bash

BASE_PATH=/var/www
APP_PATH=${BASE_PATH}/rms

sudo chown -R ec2-user:apache ${APP_PATH}
sudo chmod 2775 ${APP_PATH}
find ${APP_PATH} -type d -exec sudo chmod 2775 {} \;
find ${APP_PATH} -type f -exec sudo chmod 0664 {} \;