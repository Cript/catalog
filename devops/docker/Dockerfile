# syntax=docker/dockerfile:1

FROM php:8.1-fpm-alpine AS php_builder
RUN apk add --no-cache --virtual .php_builddeps autoconf g++ make \
    && pecl install -f xdebug \
    && apk del .php_builddeps \
    && docker-php-ext-enable xdebug
COPY devops/docker/php/xdebug.ini /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer
WORKDIR /var/www/html
COPY . ./
RUN composer install
RUN mkdir public/coverage
RUN ./bin/phpunit --coverage-html ./public/coverage
RUN composer install --no-ansi --no-dev --no-interaction --no-plugins --no-progress --no-scripts --no-autoloader
RUN composer dump-autoload --optimize

FROM node:18-alpine AS frontend_builder
WORKDIR /usr/src/app
COPY . ./
COPY --from=php_builder /var/www/html/vendor /usr/src/app/vendor
RUN yarn install
RUN yarn encore production

FROM php:8.1-fpm-alpine AS catalog

ARG USER_GID=1000
ARG USER_UID=1000

RUN addgroup -g ${USER_GID} app \
  && adduser -D -s /bin/sh -G app -u ${USER_UID} app

RUN mkdir -p /var/www/html \
    && chown -R app:app /var/www/

USER app
WORKDIR /var/www/html

COPY --from=php_builder /var/www/html/vendor /var/www/html/vendor
COPY --from=php_builder /var/www/html/public/coverage /var/www/html/public/coverage
COPY --from=frontend_builder /usr/src/app/public/build /var/www/html/public/build
