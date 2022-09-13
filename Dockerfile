FROM php:8.0-apache
LABEL maintainer 'Marco Tanaka <marco@ultrahaus.com>'

# Arguments defined in docker-compose.yml
ARG user
ARG uid

RUN a2enmod rewrite

RUN apt-get update && apt-get install -y \
            libfreetype6-dev \
            libjpeg62-turbo-dev \
            libpng-dev \
        && docker-php-ext-configure gd --with-freetype --with-jpeg \
        && docker-php-ext-install -j$(nproc) gd

RUN apt-get install -y wget

RUN apt-get install -y libmcrypt-dev \
        && pecl install mcrypt \
        && docker-php-ext-enable mcrypt

RUN docker-php-ext-install bcmath

RUN docker-php-ext-install exif 

RUN docker-php-ext-install mysqli pdo pdo_mysql \
        && docker-php-ext-enable pdo_mysql

RUN apt-get install -y \
            libzip-dev \
            zip \
        && docker-php-ext-install zip

ENV DOCKERIZE_VERSION v0.6.1
RUN wget https://github.com/jwilder/dockerize/releases/download/$DOCKERIZE_VERSION/dockerize-linux-amd64-$DOCKERIZE_VERSION.tar.gz \
    && tar -C /usr/local/bin -xzvf dockerize-linux-amd64-$DOCKERIZE_VERSION.tar.gz \
    && rm dockerize-linux-amd64-$DOCKERIZE_VERSION.tar.gz

# Create system user to run Composer and Artisan Commands
RUN useradd -G www-data,root -u $uid -d /home/$user $user
RUN mkdir -p /home/$user/.composer

COPY ./.docker/composer-installer.sh /home/$user/composer-installer.sh

RUN chown -R $user:$user /home/$user

RUN cd /home/$user

RUN /bin/bash /home/$user/composer-installer.sh

RUN mv composer.phar /usr/local/bin/composer

USER $user

# Set working directory
WORKDIR /var/www/html

