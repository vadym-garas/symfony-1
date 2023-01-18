FROM php:8.1-fpm
WORKDIR /srv/src/app

RUN apt-get -y update && apt-get -y install git unzip vim rsync

RUN git config --global user.email "user@docker.com"
RUN git config --global user.name "Docker"

RUN docker-php-ext-install pdo pdo_mysql

RUN pecl install xdebug && docker-php-ext-enable xdebug;
COPY ./docker/configs/php/xdebug.ini /usr/local/etc/php/conf.d/xdebug.ini

ENV TERM xterm-256color

RUN php -r "readfile('http://getcomposer.org/installer');" | php -- --install-dir=/usr/bin/ --filename=composer


ENTRYPOINT /bin/bash /srv/src/app/docker/configs/php/symfony_install.sh


CMD php-fpm
EXPOSE 9000