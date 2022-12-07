FROM php:8.1-fpm-alpine

ARG USER_GID=1000
ARG USER_UID=1000

RUN apk update && apk add libpq-dev supervisor \
    && docker-php-ext-install pdo pdo_pgsql

# Yandex clound
RUN wget "https://storage.yandexcloud.net/cloud-certs/CA.pem" --output-document ${YANDEX_CLOUD_CERT} && \
  chmod 0600 ${YANDEX_CLOUD_CERT}

# Php configs
RUN rm -rf /usr/local/etc/php/php-fpm.d/*.conf
COPY devops/docker/php/conf.d/      /usr/local/etc/php/conf.d
COPY devops/docker/php/php-fpm.conf /usr/local/etc/php-fpm.conf
COPY devops/docker/php/php-fpm.d/   /usr/local/etc/php-fpm.d/

# Supervisor
COPY devops/docker/php/supervisor/supervisord.conf /etc/supervisord.conf
COPY devops/docker/php/supervisor/conf.d/ /etc/supervisor/conf.d

CMD ["/usr/bin/supervisord"]

RUN addgroup -g ${USER_GID} app \
  && adduser -D -s /bin/sh -G app -u ${USER_UID} app

RUN mkdir -p /var/www/html \
    && chown -R app:app /var/www/

USER app
WORKDIR /var/www/html

COPY --chown=app:app . ./
COPY --from=aboro/kt_base /var/www/html/vendor /var/www/html/vendor
