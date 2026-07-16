FROM php:8.3-apache

# Instal koneksi MySQL dan aktifkan rewrite
RUN docker-php-ext-install pdo_mysql \
    && a2enmod rewrite

WORKDIR /var/www/html

# Salin aplikasi
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
    && chown -R www-data:www-data /var/www/html

EXPOSE 80

CMD ["apache2-foreground"]