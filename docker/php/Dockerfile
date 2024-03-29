FROM php:8.1-fpm

RUN apt-get update && apt-get install -y \
        zlib1g-dev libicu-dev g++ \
        libjpeg62-turbo-dev \
        libzip-dev \
        libpng-dev \
        libwebp-dev \
        libfreetype6-dev \
    	libxml2-dev \
    	zip

RUN docker-php-ext-configure gd --enable-gd --with-freetype --with-jpeg --with-webp
RUN docker-php-ext-install mysqli pdo pdo_mysql gd zip
RUN docker-php-ext-configure pcntl --enable-pcntl && docker-php-ext-install pcntl
