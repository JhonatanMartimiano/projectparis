FROM php:7.2-apache

COPY . /var/www/html
COPY .docker/vhost.conf /etc/apache2/sites-available/000-default.conf

WORKDIR /var/www/html

RUN apt-get update && \
    apt-get install -y \
        zlib1g-dev libicu-dev

RUN apt-get update \
    && apt-get install -y libfreetype6-dev libjpeg62-turbo-dev libpng-dev \
    && docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
    && docker-php-ext-install -j$(nproc) intl mysqli pdo_mysql bcmath mbstring exif gd

RUN chown -R www-data:www-data /var/www/html \
    && a2enmod rewrite && service apache2 restart