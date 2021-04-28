FROM php:7.3.27-apache

ARG DEBIAN_FRONTEND=noninteractive

ARG SECRETHUB_CREDENTIAL=test

# ARG SATIS_JSON=cool.com

RUN apt-get update --fix-missing && apt-get upgrade -y
RUN apt-get install -y -q --no-install-recommends \
        apt-transport-https \
        build-essential \
        ca-certificates \
        curl \
        git \
        libssl-dev \
        rsync \
        software-properties-common \
        devscripts \
        autoconf \
        ssl-cert \
        wget \
        r-base \
        r-base-dev \
        ca-certificates \
        libcurl4-openssl-dev


ENV NPM_CONFIG_LOGLEVEL info
ENV NODE_VERSION 11.14.0

# RUN buildDeps='xz-utils curl ca-certificates gnupg2 dirmngr' \
#     && set -x \
#     && apt-get update && apt-get upgrade -y && apt-get install -y $buildDeps --no-install-recommends \
#     && rm -rf /var/lib/apt/lists/* \
#     && set -ex \
#       && for key in \
#       94AE36675C464D64BAFA68DD7434390BDBE9B9C5 \
#       FD3A5288F042B6850C66B31F09FE44734EB7990E \
#       71DCFD284A79C3B38668286BC97EC7A07EDE3FC1 \
#       DD8F2338BAE7501E3DD5AC78C273792F7D83545D \
#       C4F0DFFF4E8C1A8236409D08E73BC641CC11F4C8 \
#       B9AE9905FFD7803F25714661B63B535A4C206CA9 \
#       77984A986EBC2AA786BC0F66B01FBB92821C587A \
#       8FCCA13FEF1D0C2E91008E09770F7A9A5AE15600 \
#       4ED778F539E3634C779C87C6D7062848A1AB005C \
#       A48C2BEE680E841632CD4E44F07496B3EB3C1762 \
#       B9E2F5981AA6E0CD28160D9FF13993A75599653C \
#       ; do \
#       gpg --keyserver hkp://p80.pool.sks-keyservers.net:80 --recv-keys "$key" || \
#       gpg --keyserver hkp://ipv4.pool.sks-keyservers.net --recv-keys "$key" || \
#       gpg --keyserver hkp://pgp.mit.edu:80 --recv-keys "$key" ; \
#       done \
#     && curl -SLO "https://nodejs.org/dist/v$NODE_VERSION/node-v$NODE_VERSION-linux-x64.tar.xz" \
#     && curl -SLO --compressed "https://nodejs.org/dist/v$NODE_VERSION/SHASUMS256.txt.asc" \
#     && gpg --batch --decrypt --output SHASUMS256.txt SHASUMS256.txt.asc \
#     && grep " node-v$NODE_VERSION-linux-x64.tar.xz\$" SHASUMS256.txt | sha256sum -c - \
#     && tar -xJf "node-v$NODE_VERSION-linux-x64.tar.xz" -C /usr/local --strip-components=1 \
#     && rm "node-v$NODE_VERSION-linux-x64.tar.xz" SHASUMS256.txt.asc SHASUMS256.txt \
#     && apt-get purge -y --auto-remove $buildDeps \
#     && ln -s /usr/local/bin/node /usr/local/bin/nodejs

# RUN node --version


RUN apt-get update && apt-get install -y curl gnupg2 xz-utils git

# RUN whereis git && sleep 150

RUN apt-get install ca-certificates

RUN curl -fsSL https://apt.secrethub.io/pub | apt-key add -

RUN echo "deb https://apt.secrethub.io stable main" > /etc/apt/sources.list.d/secrethub.sources.list && apt-get update

RUN apt-get install -y secrethub-cli

# RUN secrethub abd-afeez/performance init

RUN mkdir .secrethub && touch .secrethub/credential

# RUN echo $SECRETHUB_CREDENTIAL && sleep 200

RUN echo $NODE_VERSION


RUN secrethub service init abd-afeez/performance \
    --description "Performance service deployed using SSH" \
    --permission read > .secrethub/credential

RUN apt-get install -y jq

COPY azure-auth.json /var/www/html/
RUN BITBUCKET_PASSWORD=$(secrethub read abd-afeez/performance/bitbucket_password) && jq --arg pass "$BITBUCKET_PASSWORD" '.["http-basic"]["bitbucket.org"].password=$pass' azure-auth.json >> tmp.json && mv tmp.json auth.json

# RUN echo secrethub read abd-afeez/performance/bitbucket_password

# RUN cat auth.json && sleep 150

WORKDIR /var/www/html/

# RUN echo BITBUCKET_PASSWORD
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer --version=1.10.19

ADD https://raw.githubusercontent.com/mlocati/docker-php-extension-installer/master/install-php-extensions /usr/local/bin/
RUN chmod uga+x /usr/local/bin/install-php-extensions && sync && \
    install-php-extensions gd exif zip mysqli pdo_mysql

COPY . /var/www/html/

# RUN ls -la /var/www/mnt && sleep 30
# RUN ls -la /var/www && sleep 30

# RUN cd public_html && ls -la && sleep 60

# RUN jq --arg satis "$SATIS_JSON" '.url=$satis' satis.json > tmp.json && mv tmp.json satis.json


# RUN jq 'del(.scripts)' composer.example.json > hrms.json && jq --argjson repositories "$(<satis.json)" '.repositories = $repositories' hrms.json > composer.json

# RUN composer install --no-interaction --prefer-dist
# RUN apt-get -yq update && \
#      apt-get -yqq install ssh

# RUN ./docker-bb-auth.sh

# RUN jq 'del(.scripts)' composer.json > comp-test.json && mv comp-test.json composer.json

RUN  mkdir -p storage/logs && \
  mkdir -p storage/framework && \
  mkdir -p storage/framework/cache && \
  mkdir -p storage/framework/views && \
  mkdir -p storage/framework/sessions && \
  mkdir -p bootstrap/cache

# RUN composer dump-autoload

RUN COMPOSER_MEMORY_LIMIT=-1 composer install --no-scripts

# RUN npm install -g yarn gulp

# RUN ./bitbucket-auth.sh

# Make ssh dir
# RUN mkdir /root/.ssh/

# Add the keys and set permissions
# ARG SSH_KEY
# RUN echo "$SSH_KEY" > /root/.ssh/id_rsa
# RUN chmod 600 /root/.ssh/id_rsa

# Add bitbuckets key
# RUN ssh-keyscan -T 60 bitbucket.org >> /root/.ssh/known_hosts

# RUN mkdir -p /var/www/mnt && mkdir && mkdir -p /var/www/mnt/uploads

# RUN ln -s storage /var/www/mnt/storage && ln -s uploads /var/www/mnt/uploads
# storage -> /var/www/mnt/storage
# .env -> /var/www/mnt/.env
# public_html/uploads -> /var/www/mnt/uploads

# COPY package.json /var/www/html/

# RUN  jq '.dependencies["@insidify/shr-ui-library"]="bitbucket:insidify/shr-ui-library#develop"' package.json > pack-test.json && mv pack-test.json package.json
# RUN apt-get update --fix-missing && apt-get upgrade -y \ 
#   && apt-get install -y -q  build-essential libsqlite3-dev zlib1g-dev libncurses5-dev libgdbm-dev libbz2-dev libreadline-gplv2-dev libssl-dev libdb-dev \ 
#   && wget http://www.python.org/ftp/python/2.7.3/Python-2.7.3.tgz \
#   && tar -xvzf Python-2.7.3.tgz \
#   && cd Python-2.7.3 \
#   && ./configure --prefix=/usr --enable-shared \
#   && make \ 
#   && make install

# RUN npm install

# RUN npm run prod

# RUN gulp

# RUN ./docker-cleanup.sh && rm docker-cleanup.sh && rm docker-bb-auth.sh

RUN apt-get install -y ssl-cert

RUN a2enmod ssl

RUN a2ensite default-ssl.conf

# ENV APACHE_DOCUMENT_ROOT=/var/www/html/public_html
# RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
# RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

RUN a2enmod ssl
RUN a2enmod rewrite

RUN mkdir -p /etc/apache2/ssl
COPY ./ssl/*.pem /etc/apache2/ssl/
COPY ./000-default.conf /etc/apache2/sites-available/000-default.conf

EXPOSE 80
EXPOSE 443

# RUN apt-get install -y supervisor

# RUN mv supervisord.conf /etc/supervisord.conf

# RUN ./fix-scripts.sh

# RUN apt-get install -y cron && mkdir -p /etc/cron.d

# RUN mv laravel-cron /etc/cron.d/laravel-cron && chmod 0644 /etc/cron.d/laravel-cron

RUN adduser --no-create-home --disabled-password --gecos "" ec2-user

RUN mv php-prod.ini "$PHP_INI_DIR/php.ini"


# RUN mkdir -p /var/www/mnt && mv /var/www/html/storage/ /var/www/mnt/ && mv /var/www/html/public_html/uploads/ /var/www/mnt/ && mv /var/www/html/.env  /var/www/mnt/
# RUN ln -sfn /var/www/mnt/storage /var/www/html/ && ln -sfn /var/www/mnt/uploads /var/www/html/public_html/ && ln -sfn /var/www/mnt/.env /var/www/html/

# RUN ln -sfn /var/www/html/public_html /var/www/html/public
# RUN chmod 777 -R storage/
# RUN chmod -R 777 bootstrap/cache
# RUN chown -R root:www-data 
# ENTRYPOINT ["php", "artisan", "migrate", "--seed", "--"]

# ENTRYPOINT php artisan migrate --seed

CMD ["sh", "entrypoint.sh"]

# CMD ["/usr/sbin/apache2ctl", "-D", "FOREGROUND"]

# CMD /usr/sbin/apache2ctl -D FOREGROUND


