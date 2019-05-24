FROM php:7.3-apache
RUN docker-php-ext-install pdo pdo_mysql
RUN a2enmod rewrite

ARG XDEBUG=0

ADD xdebug.ini /
ADD xdebug-setup.sh /

RUN chmod +x /xdebug-setup.sh
RUN /xdebug-setup.sh $XDEBUG

RUN apt --yes update && apt --yes install libpng-dev libjpeg-dev libfreetype6-dev
RUN docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/
RUN docker-php-ext-install gd
