FROM php:8.2-fpm

# Устанавливаем системные зависимости
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    procps \
    net-tools \
    && docker-php-ext-install sockets \
    && docker-php-ext-enable sockets

# Удаляем стандартную конфигурацию и копируем нашу
RUN rm /usr/local/etc/php-fpm.d/*
COPY php-fpm.conf /usr/local/etc/php-fpm.d/www.conf

# Установка Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# Копируем composer.json и устанавливаем зависимости
COPY composer.json ./
RUN composer install

# Копируем исходный код
COPY ./www /var/www/html

# Исправляем права доступа
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html \
    && touch /var/www/html/send.log \
    && chown www-data:www-data /var/www/html/send.log \
    && chmod 666 /var/www/html/send.log

CMD ["php-fpm", "-F"]