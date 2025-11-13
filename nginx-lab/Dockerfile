FROM php:8.2-cli

RUN apt-get update && apt-get install -y unzip git

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html
COPY ./www /var/www/html

CMD ["php", "-S", "0.0.0.0:80", "-t", "/var/www/html"]