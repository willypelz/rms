#!/bin/bash

BASE_PATH=/var/www
sudo chown -R ec2-user:apache ${BASE_PATH}

mkdir -p ${BASE_PATH}/staging