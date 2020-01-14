FROM php:7.2-apache

WORKDIR /var/www

RUN apt-get update && \
    apt-get install -y \
        zlib1g-dev \
        curl \
        gnupg \
        git \
        libpng-dev \
        libfreetype6-dev \
        libjpeg62-turbo-dev

COPY ssl/ /etc/apache2/ssl/
COPY vhosts/ /etc/apache2/sites-enabled/

RUN docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/
RUN docker-php-ext-install mysqli pdo pdo_mysql zip mbstring gd
RUN a2enmod rewrite
RUN a2enmod ssl
RUN service apache2 restart

RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
RUN php composer-setup.php --filename=composer --install-dir=/usr/local/bin
RUN php -r "unlink('composer-setup.php');"
