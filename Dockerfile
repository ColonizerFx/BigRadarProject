FROM php:8.2-cli

RUN apt-get update && apt-get install -y \
    git curl zip unzip \
    libpng-dev libjpeg-dev libfreetype6-dev \
    libzip-dev libonig-dev \
    nodejs npm \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo pdo_mysql pdo_sqlite mbstring zip gd bcmath \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

COPY composer.json composer.lock ./
RUN composer install --no-dev --optimize-autoloader --no-scripts --no-interaction

COPY package.json package-lock.json* ./
RUN npm install

COPY . .
RUN npm run build

RUN chown -R www-data:www-data storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

COPY docker-entrypoint.sh /docker-entrypoint.sh
RUN chmod +x /docker-entrypoint.sh

EXPOSE 10000

CMD ["/docker-entrypoint.sh"]
