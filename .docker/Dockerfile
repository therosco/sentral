FROM php:7.2-fpm-stretch

ADD ./.docker/etc/php-fpm/conf.d/www.conf /usr/local/etc/php-fpm.d/www.conf
ADD ./.docker/*.sh /tmp/

RUN apt-get update && \
    apt-get install -y apt-utils git procps ngrep wget zip unzip zlib1g-dev inetutils-ping mysql-client curl && \
    docker-php-source extract && \
    docker-php-ext-install zip mysqli pdo_mysql && \
    docker-php-source delete

RUN /tmp/composer-install.sh

VOLUME ["/var/www/html"]
