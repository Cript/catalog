FROM php:8.1-fpm-alpine

ARG USER_GID=1000
ARG USER_UID=1000

RUN apk update && apk add libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql

RUN addgroup -g ${USER_GID} app \
  && adduser -D -s /bin/sh -G app -u ${USER_UID} app

RUN mkdir -p /var/www/html \
    && chown -R app:app /var/www/

## Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

USER app
WORKDIR /var/www/html

COPY --chown=app:app composer.json composer.lock ./

CMD ["php", "-S", "0.0.0.0:8000", "-t", "public/"]
