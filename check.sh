#!/bin/bash
set -x;

# if [[ -z $KUBE_HOST_NAME ]]; then
#     echo "point the kube meta name to the hostname"
#         export KUBE_HOST_NAME=$KUBE_META_NAME
# else
#     echo "Kube host name has been set"
# fi
if [[ "$DEPLOYMENT_TYPE" =~ .*"HRMS".* ]]; then
    export DEPLOYMENT_SUFFIX="seamlesshiring.com"
else
    export DEPLOYMENT_SUFFIX="seamlesshiring.com"
fi