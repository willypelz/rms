#!/bin/bash

BASE_PATH=/var/www
STAGING_PATH=${BASE_PATH}/staging
APP_PATH=${BASE_PATH}/rms
MNT_PATH=${BASE_PATH}/mnt
ENV_PATH=${MNT_PATH}/.env

yum update -y

#correct symlinks
if [[ ! -L "${APP_PATH}/.env" ]]; then # check if .env in app directory is NOT sym linked
  	mkdir -p /var/www/mnt 
  	mv ${MNT_PATH}/.env ${MNT_PATH}/.env.old &&
	mv ${APP_PATH}/.env ${MNT_PATH}/.env &&
	ln -sfn ${MNT_PATH}/.env ${APP_PATH}/.env
fi

sed -i 's,^:max_revisions:.*$,:max_revisions: 2,' /etc/codedeploy-agent/conf/codedeployagent.yml

sed -i 's,^SENTRY_LARAVEL_DSN=.*$,SENTRY_LARAVEL_DSN=https://70514ab6512e4e12868c63227ea7135e@o1150461.ingest.sentry.io/6234946,' ${ENV_PATH}

sed -i 's,^APP_DEBUG=.*$,APP_DEBUG=false,' ${ENV_PATH}
grep '^APP_DEBUG' ${ENV_PATH}  >> ${DEBUG_FILE}

sed -i 's,^CACHE_DRIVER=.*$,CACHE_DRIVER=redis,' ${ENV_PATH}
grep '^CACHE_DRIVER' ${ENV_PATH}  >> ${DEBUG_FILE}

sed -i 's,^SESSION_DRIVER=.*$,SESSION_DRIVER=redis,' ${ENV_PATH}
grep '^SESSION_DRIVER' ${ENV_PATH}  >> ${DEBUG_FILE}

sed -i 's,^QUEUE_DRIVER=.*$,QUEUE_DRIVER=redis,' ${ENV_PATH}
grep '^QUEUE_DRIVER' ${ENV_PATH}  >> ${DEBUG_FILE}

if grep '^SENTRY_TRACES_SAMPLE_RATE' ${ENV_PATH}
then
	sed -i 's,^SENTRY_TRACES_SAMPLE_RATE=.*$,SENTRY_TRACES_SAMPLE_RATE=1.0,' ${ENV_PATH} 
else
	echo "SENTRY_TRACES_SAMPLE_RATE=1.0" >> ${ENV_PATH}
fi
grep '^SENTRY_TRACES_SAMPLE_RATE' ${ENV_PATH} >> ${DEBUG_FILE}


if grep '^TELESCOPE_ENABLED' ${ENV_PATH}
then
	sed -i 's,^TELESCOPE_ENABLED=.*$,TELESCOPE_ENABLED=false,' ${ENV_PATH} 
else
	echo "TELESCOPE_ENABLED=false" >> ${ENV_PATH}
fi
grep '^TELESCOPE_ENABLED' ${ENV_PATH} >> ${DEBUG_FILE}


if grep '^TELESCOPE_KEY' ${ENV_PATH}
then
	sed -i 's,^TELESCOPE_KEY=.*$,TELESCOPE_KEY=false,' ${ENV_PATH} 
else
	echo "TELESCOPE_KEY=false" >> ${ENV_PATH}
fi
grep '^TELESCOPE_KEY' ${ENV_PATH} >> ${DEBUG_FILE}
