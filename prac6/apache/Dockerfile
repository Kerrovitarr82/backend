FROM php:8.0-apache
RUN apt-get update
RUN a2enmod authn_dbd # подключаем модуль для аутентификации юзеров с помощью поиска их в sql таблицах
RUN apt-get install -y apache2-utils libaprutil1-dbd-mysql # содержит драйвер базы данных MySQL/mariadb
RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli
RUN docker-php-ext-install pdo pdo_mysql
RUN apt-get update -y && apt-get install -y sendmail libpng-dev
RUN docker-php-ext-install gd
RUN apt-get update && apt-get install -y \
    zlib1g-dev \
    libzip-dev \
    unzip
RUN apt-get update \
	&& apt-get -y install tnef \
	&& rm -rf /var/lib/apt/lists/* \
	&& curl -o jpgraph.tar.gz -SL "https://jpgraph.net/download/download.php?p=55" \
	&& mkdir -p /var/www/html/jpgraph \
	&& tar -xzf jpgraph.tar.gz --strip-components=1 -C /var/www/html/jpgraph \
	&& rm jpgraph.tar.gz
RUN docker-php-ext-install zip
RUN pecl install redis && docker-php-ext-enable redis
COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer
COPY composer.json /var/www/html
RUN composer install