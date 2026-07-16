FROM php:8.3-apache

# Instal PDO MySQL
RUN docker-php-ext-install pdo_mysql

# Pastikan hanya mpm_prefork yang aktif
RUN a2dismod mpm_event mpm_worker 2>/dev/null || true \
    && rm -f /etc/apache2/mods-enabled/mpm_event.load \
             /etc/apache2/mods-enabled/mpm_event.conf \
             /etc/apache2/mods-enabled/mpm_worker.load \
             /etc/apache2/mods-enabled/mpm_worker.conf \
    && a2enmod mpm_prefork rewrite

WORKDIR /var/www/html

COPY . /var/www/html/

# Izinkan penggunaan .htaccess
RUN printf '%s\n' \
    '<Directory /var/www/html>' \
    '    AllowOverride All' \
    '    Options FollowSymLinks' \
    '    Require all granted' \
    '</Directory>' \
    > /etc/apache2/conf-available/eduplay.conf \
    && a2enconf eduplay \
    && chown -R www-data:www-data /var/www/html \
    && apache2ctl configtest

EXPOSE 8080

# Sesuaikan Apache dengan port Railway
CMD ["sh", "-c", "sed -ri \"s!Listen [0-9]+!Listen ${PORT:-8080}!\" /etc/apache2/ports.conf && sed -ri \"s!<VirtualHost \\*:[0-9]+>!<VirtualHost *:${PORT:-8080}>!\" /etc/apache2/sites-available/000-default.conf && exec apache2-foreground"]