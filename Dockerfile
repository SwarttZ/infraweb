FROM php:7.4-fpm

RUN apt-get update

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpq-dev \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libzip-dev \
    zip \
    unzip \
    nano \
    ghostscript \
    default-mysql-client \
    sudo


# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd


#Mcrypt
RUN apt-get update && apt-get install -y libmcrypt-dev \
    && pecl install mcrypt-1.0.4 \
    && docker-php-ext-enable mcrypt

#Instal new version for laravel php7.4
RUN pecl install memcached; \
    pecl install mcrypt; \
    pecl install redis; \
    pecl install apcu; \
    pecl install gmagick-2.0.6RC1; \
    pecl install timezonedb; \
    docker-php-ext-configure gd --with-freetype --with-jpeg; \
    docker-php-ext-configure zip; \
    docker-php-ext-install gd; \
    PHP_OPENSSL=yes docker-php-ext-configure imap --with-kerberos --with-imap-ssl; \
    docker-php-ext-install imap; \
    docker-php-ext-install mysqli; \
    docker-php-ext-install pdo_mysql; \
    docker-php-ext-install opcache; \
    docker-php-ext-install soap; \
    docker-php-ext-install intl; \
    docker-php-ext-install zip; \
    docker-php-ext-install exif; \
    docker-php-ext-install calendar; \
    docker-php-ext-install gmp; \
    docker-php-ext-install pcntl; \
    docker-php-ext-install shmop; \
    docker-php-ext-install sockets; \
    docker-php-ext-install sysvsem; \
    docker-php-ext-install sysvshm; \
    docker-php-ext-install bcmath; \
    docker-php-ext-enable mcrypt redis timezonedb apcu; \
    echo "extension=memcached.so" >> /usr/local/etc/php/conf.d/memcached.ini; \
    echo "extension=gmagick.so" >> /usr/local/etc/php/conf.d/gmagick.ini; \
    apt-get purge -y --auto-remove -o APT::AutoRemove::RecommendsImportant=false; \
    rm -rf /var/lib/apt/lists/*;

# set recommended PHP.ini settings
# see https://secure.php.net/manual/en/opcache.installation.php
RUN { \
    echo 'opcache.memory_consumption=128'; \
    echo 'opcache.interned_strings_buffer=8'; \
    echo 'opcache.max_accelerated_files=4000'; \
    echo 'opcache.revalidate_freq=2'; \
    echo 'opcache.fast_shutdown=1'; \
    echo 'opcache.enable_cli=1'; \
    } > /usr/local/etc/php/conf.d/opcache-recommended.ini


## Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

RUN pecl install -o -f redis \
    && rm -rf /tmp/pear \
    && docker-php-ext-enable redis

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Install XDebug for PHPUnit Code Coverage
RUN yes | pecl install xdebug \
    && echo "zend_extension=$(find /usr/local/lib/php/extensions/ -name xdebug.so)" > /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "xdebug.remote_enable=on" >> /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "xdebug.remote_autostart=off" >> /usr/local/etc/php/conf.d/xdebug.ini

# Set working directory
WORKDIR /var/www/html

COPY . .
# Create system user to run Composer and Artisan Commands
RUN useradd -G www-data,root -ms /bin/bash -d /home/luffy luffy
RUN echo "luffy:mklider" | chpasswd
RUN sudo usermod -aG sudo luffy
RUN mkdir -p /home/luffy/.composer && \
    chown -R luffy:luffy /var/www/html


USER luffy
