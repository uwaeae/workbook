FROM php:5.6-apache


RUN export DEBIAN_FRONTEND=noninteractive

RUN sed -i 's/main/main contrib/' /etc/apt/sources.list \
    && apt-get update -q \
    && apt-get install -qq --no-install-recommends \
        apt-transport-https \
        lsb-release \
        libmagickwand-dev \
        imagemagick \
        libicu-dev \
        libxml++2.6-dev \
        g++ \
        gnupg2 \
        mysql-client \
        git \
        ghostscript \
        zip unzip \
        openssh-client \
        vim-tiny

RUN docker-php-ext-install pcntl pdo pdo_mysql intl mbstring

COPY docker/dev/php.ini /usr/local/etc/php/

VOLUME ["/www-root"] 

ADD docker/dev/apache-config.conf /etc/apache2/sites-enabled/000-default.conf
RUN a2enmod rewrite
EXPOSE 80

WORKDIR /www-root

CMD /www-root/docker/dev/run.sh

