FROM php:7.3-fpm-alpine

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
        oniguruma-dev \
        libjpeg-turbo \
        libjpeg-turbo-dev \
    && docker-php-ext-configure gd \
        --with-freetype-dir=/usr/include/ \
        --with-jpeg-dir=/usr/include/ \
    && docker-php-ext-install -j$(nproc) gd \
    && apk del \
        freetype-dev \
        libpng-dev \
        libjpeg-turbo-dev \
    \
    && rm /var/cache/apk/*

RUN docker-php-ext-install pdo pdo_mysql mbstring
RUN docker-php-ext-install opcache

RUN apk --no-cache add shadow \
    && usermod -u 1000 www-data \
    && groupmod -g 1000 www-data

ENTRYPOINT ["docker-php-entrypoint"]
 
STOPSIGNAL SIGQUIT
 
EXPOSE 9000
CMD ["php-fpm"]
