#!/bin/bash
set -x;

# mkdir -p /var/www/mnt/storage
# # look for empty dir
# if [ "$(ls -A /var/www/mnt/$CLIENT_NAME)" ]; then
# #     echo "Take action $DIR is not Empty"
    mv /var/www/html/public_html/uploads up
    rm -r /var/www/html/storage
    #rm -r /var/www/html/public_html/uploads
    rm -r /var/www/html/public_html/img
    rm /var/www/html/.env
# else
#     echo "$DIR is Empty"
#     rm -r mydir
#     mv /var/www/html/storage /var/www/mnt
#     mv /var/www/html/public_html/uploads /var/www/mnt
#     # mv /var/www/html/.env  /var/www/mnt
# fi

ln -sfn /var/www/mnt/storage /var/www/html/
ln -sfn /var/www/mnt/uploads /var/www/html/public_html/
ln -sfn /var/www/mnt/img /var/www/html/public_html/
ln -sfn /var/www/mnt/.env /var/www/html/

cp -vnpr up/* /var/www/html/public_html/uploads

rm -rf up

cd /var/www/html

php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# echo "//log" > storage/logs/laravel.log
chmod -R 777 storage
chmod -R 777 bootstrap/cache
chmod -R 775 /var/www/html/public/uploads
chmod -R 775 /var/www/html/public/img

chown -R www-data:www-data /var/www/html/public/uploads
# chown -R root:www-data /tmp
# chown -R root:www-data /storage

if [ $ENABLE_ATATUS -eq "true" ]; then
    cd ~ \
        && export ATATUS_RELEASE="atatus-php-1.10.3-x64-debian" \
        && curl -sS "https://s3.amazonaws.com/atatus-artifacts/atatus-php/downloads/${ATATUS_RELEASE}.tar.gz" | tar xvzf - \
        && cd "${ATATUS_RELEASE}" \
        && ATATUS_LICENSE_KEY="${ATATUS_LICENSE_KEY}" ATATUS_APP_NAME="${CLIENT_NAME}" bash install.sh \
        && cd .. \
        && unset ATATUS_RELEASE
fi

cd /var/www/html

# {
#     set -e
#     php artisan migrate --seed --force
# }
php artisan migrate --seed --force
composer dump-autoload

chmod u+x fix-scripts.sh

./fix-scripts.sh

cd /etc && /usr/bin/supervisord

# supervisorctl reread && supervisorctl reload && supervisorctl stop all && supervisorctl start all

supervisorctl reread && supervisorctl reload && supervisorctl restart all
crontab /etc/cron.d/laravel-cron
service cron start
service cron status

/usr/sbin/apache2ctl -D FOREGROUND