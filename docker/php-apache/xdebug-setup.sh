#!/bin/bash

if [ "$1" == 1 ]; then
    printf "\nXdebug setup...\n"
    printf "\nRunning pecl install xdebug-2.5.5 && docker-php-ext-enable xdebug...\n"
    pecl install xdebug-2.5.5 && docker-php-ext-enable xdebug

    printf "\nRunning cat /xdebug.ini >> $PHP_INI_DIR/conf.d/docker-php-ext-xdebug.ini\n"
    cat /xdebug.ini >> $PHP_INI_DIR/conf.d/docker-php-ext-xdebug.ini

    printf "\nXdebug installed!!\n\n"
    exit 0
fi
