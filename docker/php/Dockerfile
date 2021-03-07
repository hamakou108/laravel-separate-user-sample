FROM php:8.0.3

WORKDIR /opt

# Install dependency
RUN apt update && apt install -y git

# Install composer
RUN curl -sS https://getcomposer.org/installer -o composer-setup.php \
    && php composer-setup.php --install-dir=/usr/local/bin --filename=composer \
    && rm composer-setup.php

RUN docker-php-ext-install pdo_mysql
