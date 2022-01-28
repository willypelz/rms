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


RUN apt-get update && apt-get install -y curl gnupg2 xz-utils git


RUN apt-get install ca-certificates

RUN curl -fsSL https://apt.secrethub.io/pub | apt-key add -

#RUN echo "deb https://apt.secrethub.io stable main" > /etc/apt/sources.list.d/secrethub.sources.list && apt-get update
RUN echo "deb [trusted=yes] https://apt.secrethub.io stable main" > /etc/apt/sources.list.d/secrethub.sources.list && apt-get update
RUN apt-get install -y secrethub-cli
RUN apt-get install -y secrethub-cli


RUN mkdir .secrethub && touch .secrethub/credential


RUN echo $NODE_VERSION


RUN secrethub service init abd-afeez/performance \
    --description "Performance service deployed using SSH" \
    --permission read > .secrethub/credential

RUN apt-get install -y jq

COPY azure-auth.json /var/www/html/
RUN BITBUCKET_PASSWORD=$(secrethub read abd-afeez/performance/bitbucket_password) && jq --arg pass "$BITBUCKET_PASSWORD" '.["http-basic"]["bitbucket.org"].password=$pass' azure-auth.json >> tmp.json && mv tmp.json auth.json


WORKDIR /var/www/html/

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer --version=2.1.12

ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/
RUN chmod uga+x /usr/local/bin/install-php-extensions && sync && \
    install-php-extensions gd exif zip mysqli posix pcntl pdo_mysql

COPY . /var/www/html/

RUN  mkdir -p storage/logs && \
  mkdir -p storage/framework && \
  mkdir -p storage/framework/cache && \
  mkdir -p storage/framework/views && \
  mkdir -p storage/framework/sessions && \
  mkdir -p bootstrap/cache


RUN rm composer.lock

RUN COMPOSER_MEMORY_LIMIT=-1 composer install --no-scripts
# RUN COMPOSER_MEMORY_LIMIT=-1 composer install

RUN apt-get install -y ssl-cert

RUN a2enmod ssl

RUN a2ensite default-ssl.conf

RUN a2enmod ssl
RUN a2enmod rewrite

RUN mkdir -p /etc/apache2/ssl
COPY ./ssl/*.pem /etc/apache2/ssl/
COPY ./000-default.conf /etc/apache2/sites-available/000-default.conf

EXPOSE 80
EXPOSE 443

RUN apt-get -yq update && apt-get install -y supervisor

RUN mv supervisord.conf /etc/supervisord.conf

RUN chmod u+x ./fix-scripts.sh

RUN ./fix-scripts.sh

RUN apt-get -yq update && apt-get install -y cron && mkdir -p /etc/cron.d

RUN mv laravel-cron /etc/cron.d/laravel-cron && chmod 0644 /etc/cron.d/laravel-cron

RUN adduser --no-create-home --disabled-password --gecos "" ec2-user

RUN mv php-prod.ini "$PHP_INI_DIR/php.ini"

CMD ["sh", "entrypoint.sh"]
