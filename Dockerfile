FROM php:8.3-apache

# Dukungan MySQL dan .htaccess
RUN docker-php-ext-install pdo_mysql \
    && a2enmod rewrite

# Jalankan Apache pada port 8080
RUN sed -ri 's!^Listen 80!Listen 8080!' /etc/apache2/ports.conf \
    && sed -ri 's!<VirtualHost \*:80>!<VirtualHost *:8080>!' \
       /etc/apache2/sites-available/000-default.conf

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
    && chown -R www-data:www-data /var/www/html

EXPOSE 8080

CMD ["apache2-foreground"]