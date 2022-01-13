FROM php:8-fpm

RUN apt-get update && apt-get install -y git zip libpq-dev
RUN pecl install xdebug && docker-php-ext-enable xdebug
RUN docker-php-ext-install pdo_pgsql

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

ARG USER_ID
ARG GROUP_ID

RUN groupadd -r app -g ${GROUP_ID} && \
    useradd  -u ${USER_ID} -r -g app -s /sbin/nologin app

USER app

WORKDIR /var/www
