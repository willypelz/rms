#!/bin/bash

BASE_PATH=/var/www
sudo chown ec2-user:apache ${BASE_PATH}

mkdir -p ${BASE_PATH}/staging

