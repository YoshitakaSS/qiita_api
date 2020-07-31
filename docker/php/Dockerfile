FROM php:7.3-fpm

COPY php.ini /usr/local/etc/php/

RUN apt-get update \
  && apt-get install -y zlib1g-dev mariadb-client libzip-dev libxml2-dev unzip git

RUN git clone https://github.com/phpredis/phpredis.git /usr/src/php/ext/redis

RUN docker-php-ext-install -j$(nproc) \
    zip \
    pdo_mysql \
    redis

RUN pecl install xdebug \
  && docker-php-ext-enable xdebug

# composer install
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set composer environment
ENV COMPOSER_ALLOW_SUPERUSER 1
ENV COMPOSER_HOME /composer
ENV PATH $PATH:/composer/vendor/bin

ARG XDEBUG_IDEKEY
ARG XDEBUG_REMOTE_HOST
ARG XDEBUG_REMOTE_CONNECT_BACK

WORKDIR /var/www/qiita

RUN composer global require "laravel/installer"
# for blade
RUN composer require --dev barryvdh/laravel-debugbar
# for api develop
RUN composer require --dev laravel/telescope 
# for schedule list
RUN composer require --dev hmazter/laravel-schedule-list 

# RUN /usr/sbin/setenforce Permissive

# COPY ./local_setting/init.sh /etc/rc.d/init.sh

# RUN chmod 777 /etc/rc.d/init.sh