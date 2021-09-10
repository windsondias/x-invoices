FROM php:8.0-fpm

RUN groupadd -g 1000 www
RUN useradd -u 1000 -ms /bin/bash -g www www

RUN chown www:www /var/www

WORKDIR /var/www

RUN apt-get update && apt-get install -y \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libpng-dev \
        libpq-dev \
        libonig-dev \
        libxml2-dev \
        libzip-dev \
        libcurl4-openssl-dev

RUN apt-get clean && rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-install pdo pdo_pgsql pdo_mysql mbstring exif pcntl bcmath gd curl xml zip soap intl

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer




