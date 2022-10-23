FROM php:8.1.0-fpm

#ARG user
#ARG uid

# Instalando as dependências
RUN apt-get update && apt-get install -y \
    curl \
    libcurl3-dev \
    libcurl4-openssl-dev \
    libldb-dev \
    libonig-dev \
    libpq-dev \
    libzip-dev \
    libc-dev \
    libmagickwand-dev \
    zip \
    unzip \
   # python3-pip \
   # composer \
    vim 
   

    
    

#RUN curl -sS https://getcomposer.org/installer -o composer-setup.php
#RUN php composer-setup.php --install-dir=/usr/local/bin --filename=composer
# Limpando o cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

#RUN curl -sS https://getcomposer.org/installer -o composer-setup.php
#RUN php composer-setup.php --install-dir=/usr/local/bin --filename=composer

# Instalando Extensões PHP
#RUN docker-php-ext-install curl gd intl mbstring opcache pdo_pgsql xml zip
RUN docker-php-ext-install curl gd intl mbstring opcache pdo_pgsql zip



RUN pecl install xdebug && docker-php-ext-enable xdebug

RUN useradd -G www-data,root -u 1000 -d /home/app app
RUN mkdir -p /home/app/.composer && \
    chown -R app:app /home/app


WORKDIR /var/www

ENTRYPOINT ["php-fpm"]
USER app
#EXPOSE 9000
