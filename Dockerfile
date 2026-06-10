FROM php:8.5-apache

# Переназначаем UID/GID www-data на хостового пользователя для совместимости прав
ARG HOST_UID=1000
ARG HOST_GID=1000
RUN groupmod -g ${HOST_GID} www-data \
    && usermod -u ${HOST_UID} -g ${HOST_GID} www-data \
    && chown -R www-data:www-data /var/log/apache2 /run/apache2 /var/www/html

# Установка зависимостей и PHP-расширений
RUN apt-get update && apt-get install -y --no-install-recommends \
    git unzip zip pkg-config libzip-dev libpng-dev libjpeg-dev libfreetype6-dev libwebp-dev libonig-dev libxml2-dev \
    libcurl4-openssl-dev zlib1g-dev libssl-dev libevent-dev libxml2-utils \
    libmemcached-dev libsasl2-dev msmtp cron \
    && docker-php-ext-configure gd \
        --with-freetype \
        --with-jpeg \
        --with-webp \
    && docker-php-ext-install -j"$(nproc)" pdo pdo_mysql mysqli zip gd sockets \
    && printf "\n" | pecl install memcached \
    && docker-php-ext-enable memcached \
    && rm -rf /var/lib/apt/lists/*

# Установка Xdebug
RUN pecl install xdebug && docker-php-ext-enable xdebug

# Https для сайта
RUN mkdir /etc/apache2/ssl && \
    openssl req -x509 -nodes -days 365 \
    -subj "/C=RU/ST=MSK/L=Moscow/O=Dev/OU=Dev/CN=localhost" \
    -newkey rsa:2048 \
    -keyout /etc/apache2/ssl/apache.key \
    -out /etc/apache2/ssl/apache.crt

# Копируем конфиги
COPY ./xdebug.ini /usr/local/etc/php/conf.d/xdebug.ini
COPY ./php.ini /usr/local/etc/php/php.ini
COPY ./vhost.conf /etc/apache2/sites-available/000-default.conf
COPY ./vhost-internal.conf /etc/apache2/sites-available/internal.conf
COPY ./vhost-ssl.conf /etc/apache2/sites-available/default-ssl.conf
COPY ./vhost-internal-ssl.conf /etc/apache2/sites-available/internal-ssl.conf
COPY ./ports.conf /etc/apache2/ports.conf

RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

# Apache модули
RUN a2enmod rewrite ssl
RUN a2ensite default-ssl internal internal-ssl

# Установка рабочей директории
WORKDIR /var/www/html

COPY ./entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

EXPOSE 80 443 40080 40443

ENTRYPOINT ["entrypoint.sh"]