#!/bin/bash
set -x;

# if [[ -z $KUBE_HOST_NAME ]]; then
#     echo "point the kube meta name to the hostname"
#         export KUBE_HOST_NAME=$KUBE_META_NAME
# else
#     echo "Kube host name has been set"
# fi
DEPLOYMENT_TYPE="HRMS"
export KUBE_META_NAME="stability-admin"
export MIN_REPLICAS=1
export MAX_REPLICAS=3
export HPA_CPU_UTZ=200
if [[ "$DEPLOYMENT_TYPE" =~ .*"HRMS".* ]]; then
    export DEPLOYMENT_SUFFIX="seamlesstesting.com"
else
    export DEPLOYMENT_SUFFIX=$PAYDAY_HOST_SUFFIX
fi