FROM php:8.1-fpm-bullseye

RUN apt-get update && apt-get install -y unzip curl git vim jq libzip-dev libcurl4-openssl-dev pkg-config libssl-dev
RUN docker-php-ext-install zip
#RUN docker-php-ext-install sockets
RUN docker-php-ext-install mysqli pdo pdo_mysql
RUN docker-php-ext-install opcache
#RUN pecl install xdebug && docker-php-ext-enable xdebug
#RUN echo 'xdebug.mode=coverage' >> /usr/local/etc/php/php.ini
COPY docker/php/conf.d/opcache.ini /usr/local/etc/php/conf.d/opcache.ini

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

ADD . /var/www/html
WORKDIR /var/www/html

#RUN composer config --global bitbucket-oauth.bitbucket.org E6VwfDBX2jbms7XTmr GMkVU8PeYwMbASvmEbTPyBTNUfwnUpPH
#CMD bash -c "php-fpm"

