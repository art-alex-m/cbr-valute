FROM ubuntu:20.04

LABEL maintainer="ArtAlexM"

ARG WWWGROUP

WORKDIR /var/www/html

ENV DEBIAN_FRONTEND noninteractive
ENV TZ=UTC

RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone

# Packages install
RUN apt-get update \
    && apt-get install -y gnupg gosu curl ca-certificates zip unzip git supervisor  \
    sqlite3 libcap2-bin libpng-dev python2 mc mysql-client

# Add php repository
RUN mkdir -p ~/.gnupg \
    && chmod 600 ~/.gnupg \
    && echo "disable-ipv6" >> ~/.gnupg/dirmngr.conf \
    && apt-key adv --homedir ~/.gnupg --keyserver hkp://keyserver.ubuntu.com:80 --recv-keys E5267A6C \
    && apt-key adv --homedir ~/.gnupg --keyserver hkp://keyserver.ubuntu.com:80 --recv-keys C300EE8C \
    && echo "deb http://ppa.launchpad.net/ondrej/php/ubuntu focal main" > /etc/apt/sources.list.d/ppa_ondrej_php.list

# Install php
RUN apt-get update \
    && apt-get install -y php8.1-cli

# Install php extensions
RUN apt-get install -y php8.1-mysql php8.1-sqlite3 php8.1-gd \
       php8.1-curl php8.1-imap php8.1-mbstring \
       php8.1-xml php8.1-zip php8.1-bcmath php8.1-soap \
       php8.1-intl php8.1-readline php8.1-pcov \
       php8.1-msgpack php8.1-igbinary php8.1-ldap \
       php8.1-redis php8.1-swoole php8.1-xdebug

# Install php composer
RUN php -r "readfile('http://getcomposer.org/installer');" | php -- --install-dir=/usr/bin/ --filename=composer

# Clean instalation
RUN apt-get -y autoremove \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

RUN groupadd --force -g $WWWGROUP cbr
RUN useradd -ms /bin/bash --no-user-group -g $WWWGROUP -u 1337 cbr

COPY start-container /usr/local/bin/start-container
COPY supervisord.conf /etc/supervisor/conf.d/supervisord.conf

COPY php.ini /etc/php/8.1/cli/conf.d/99-cbr.ini
COPY xdebug.ini /etc/php/8.1/cli/conf.d/99-xdebug.ini

RUN chmod +x /usr/local/bin/start-container

EXPOSE 80

ENTRYPOINT ["start-container"]
