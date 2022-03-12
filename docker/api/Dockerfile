FROM php:8.1-fpm-bullseye

COPY --from=composer:2.1 /usr/bin/composer /usr/bin/composer

COPY --from=node:17.4 /usr/local/bin/ /usr/local/bin/
COPY --from=node:17.4 /usr/local/lib/node_modules /usr/local/lib/node_modules

ENV TZ=Asia/Tokyo \ 
　LANG=ja_JP.UTF-8 \
  LANGUAGE=ja_JP:ja \
  LC_ALL=ja_JP.UTF-8 \
  COMPOSER_ALLOW_SUPERUSER=1

RUN apt-get update && \
  apt-get install -y tzdata git unzip locales libpq-dev libmagickwand-dev --no-install-recommends && \
  apt-get clean && \
  docker-php-ext-install pdo_pgsql && \
  pecl install imagick && \
  docker-php-ext-enable imagick && \
  locale-gen && \
  localedef -f UTF-8 -i ja_JP ja_JP && \
  rm -rf /var/lib/apt/lists/* && \
  mkdir /var/run/php-fpm && \
  composer config -g repos.packagist composer https://packagist.org

COPY ./zzz-www.conf /usr/local/etc/php-fpm.d/zzz-www.conf
COPY ./php.ini /usr/local/etc/php/php.ini
COPY ./init.sh /tmp/init.sh

WORKDIR /var/www/html