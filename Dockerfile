FROM php:8.2-fpm

ARG user
ARG uid

RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libwebp-dev

RUN docker-php-ext-install dom
RUN docker-php-ext-install gd 
RUN docker-php-ext-install pdo_mysql
RUN docker-php-ext-install mbstring 
RUN docker-php-ext-install exif 
RUN docker-php-ext-install intl 
RUN docker-php-ext-install pcntl
RUN docker-php-ext-install bcmath 

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Add a new user
RUN useradd -G www-data,root -u $uid -d /home/$user $user && \
    mkdir -p /home/$user/.composer && \
    chown -R $user:$user /home/$user

WORKDIR /var/www

USER $user
