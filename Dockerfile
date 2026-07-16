FROM php:8.3-fpm-bookworm

RUN docker-php-ext-install pdo_mysql \
    && apt-get update \
    && apt-get install -y --no-install-recommends nginx supervisor \
    && rm -rf /var/lib/apt/lists/*

WORKDIR /var/www/html

COPY . /var/www/html
COPY docker/nginx.conf /etc/nginx/nginx.conf
COPY docker/default.conf /etc/nginx/conf.d/default.conf
COPY docker/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

RUN mkdir -p /run/nginx /var/log/supervisor /var/www/html/uploads \
    && chown -R www-data:www-data /var/www/html

EXPOSE 8080

CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf"]
