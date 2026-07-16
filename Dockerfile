FROM php:8.3-apache

# Instal dukungan PDO MySQL
RUN docker-php-ext-install pdo_mysql

# Aktifkan .htaccess dan mod_rewrite
RUN a2enmod rewrite

WORKDIR /var/www/html

# Salin proyek
COPY . /var/www/html/

# Izinkan konfigurasi .htaccess
RUN printf '<Directory /var/www/html>\n\
    AllowOverride All\n\
    Options FollowSymLinks\n\
    Require all granted\n\
</Directory>\n' \
    > /etc/apache2/conf-available/eduplay.conf \
    && a2enconf eduplay \
    && chown -R www-data:www-data /var/www/html

EXPOSE 8080

# Railway memberikan port melalui variabel PORT
CMD ["sh", "-c", "sed -i \"s/Listen 80/Listen ${PORT:-8080}/\" /etc/apache2/ports.conf && sed -i \"s/\\*:80/\\*:${PORT:-8080}/\" /etc/apache2/sites-available/000-default.conf && apache2-foreground"]