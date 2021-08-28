FROM php:7.4-fpm-alpine

ENV LANG en_US.UTF-8
ENV LANGUAGE en_US.UTF-8
ENV LC_ALL=en_US.UTF-8

RUN sed -i 's/dl-cdn.alpinelinux.org/mirrors.ustc.edu.cn/g' /etc/apk/repositories && \
    echo "Asia/Shanghai" > /etc/timezone

RUN apk add \
        freetype \
        freetype-dev \
        libpng \
        libpng-dev \
        gmp-dev \
        oniguruma-dev \
        libjpeg-turbo \
        libjpeg-turbo-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd gmp \
    && apk del \
        freetype-dev \
        libpng-dev \
        libjpeg-turbo-dev

RUN docker-php-ext-install pdo pdo_mysql mbstring opcache exif

RUN apk add autoconf automake make gcc g++ libtool pkgconfig 

# Install APCu and APC backward compatibility
RUN pecl install apcu \
    && pecl install apcu_bc-1.0.3 \
    && docker-php-ext-enable apcu --ini-name 10-docker-php-ext-apcu.ini \
    && docker-php-ext-enable apc --ini-name 20-docker-php-ext-apc.ini

RUN set -xe \
    && apk add --no-cache --virtual .build-deps \
    $PHPIZE_DEPS \
    && cd /tmp && wget -O tideways.tar.gz https://github.com/tideways/php-xhprof-extension/archive/v5.0.2.tar.gz \
    && tar xfvz tideways.tar.gz && cd php-xhprof-extension-* && phpize && ./configure && make && make install \
    && docker-php-ext-enable opcache tideways_xhprof \
    && rm -rf /tmp/* /var/www/*

RUN echo 'tideways.auto_prepend_library=0' >> ${PHP_INI_DIR}/conf.d/docker-php-ext-tideways.ini

RUN apk add --no-cache graphviz ttf-freefont

RUN apk --no-cache add shadow \
    && usermod -u 1000 www-data \
    && groupmod -g 1000 www-data \
    && rm /var/cache/apk/*

ENTRYPOINT ["docker-php-entrypoint"]

STOPSIGNAL SIGQUIT

EXPOSE 9000
CMD ["php-fpm"]
