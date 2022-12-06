FROM nginx:1.23-alpine

COPY devops/docker/nginx/app.nginx /etc/nginx/conf.d/default.conf
COPY devops/docker/nginx/nginx.nginx /etc/nginx/nginx.conf

ARG USER_GID=1000
ARG USER_UID=1000

RUN addgroup -g ${USER_GID} app \
    && adduser -D -s /bin/sh -G app -u ${USER_UID} app

RUN mkdir -p /var/www/html/public \
    && chown -R app:app /var/www

COPY --from=aboro/kt_base /var/www/html/public/coverage /var/www/html/public/coverage
COPY --from=aboro/kt_base /var/www/html/public/build /var/www/html/public/build

CMD ["nginx", "-g", "daemon off;"]
