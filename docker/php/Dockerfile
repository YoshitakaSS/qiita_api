FROM php:7.3-fpm

COPY php.ini /usr/local/etc/php/

RUN apt-get update \
  && apt-get install -y zlib1g-dev mariadb-client libzip-dev libxml2-dev unzip \
  && docker-php-ext-install zip pdo_mysql \
  && docker-php-ext-install zip 

#Composer install
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set composer environment
ENV COMPOSER_ALLOW_SUPERUSER 1
ENV COMPOSER_HOME /composer
ENV PATH $PATH:/composer/vendor/bin

ARG XDEBUG_IDEKEY
ARG XDEBUG_REMOTE_HOST
ARG XDEBUG_REMOTE_CONNECT_BACK

RUN echo 'xdebug.var_display_max_children = -1\n\
xdebug.var_display_max_data = -1\n\
xdebug.var_display_max_depth = -1\n\
xdebug.idekey = "XDEBUG_IDEKEY"\n\
xdebug.remote_enable = 1\n\
xdebug.remote_autostart = 1\n\
xdebug.remote_host = "XDEBUG_REMOTE_HOST"\n\
xdebug.remote_connect_back = XDEBUG_REMOTE_CONNECT_BACK\n\
' >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && sed -i -e "s/XDEBUG_IDEKEY/${XDEBUG_IDEKEY}/" /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && sed -i -e "s/XDEBUG_REMOTE_HOST/${XDEBUG_REMOTE_HOST}/" /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && sed -i -e "s/XDEBUG_REMOTE_CONNECT_BACK/${XDEBUG_REMOTE_CONNECT_BACK}/" /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini

WORKDIR /var/www/dev-web

RUN composer global require "laravel/installer"
RUN composer require --dev barryvdh/laravel-debugbar

# RUN /usr/sbin/setenforce Permissive

# COPY ./local_setting/init.sh /etc/rc.d/init.sh

# RUN chmod 777 /etc/rc.d/init.sh