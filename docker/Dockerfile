# Sử dụng image PHP chính thức
FROM php:8.1-fpm

# Cài đặt các thư viện và tiện ích cần thiết
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libzip-dev \
    libicu-dev \
    libxslt1-dev \
    git \
    unzip \
    libpq-dev \
    libssl-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd zip intl pdo pdo_mysql xsl

# Cài đặt các extension PHP
RUN pecl install redis mongodb \
    && docker-php-ext-enable redis mongodb

# Cài đặt Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Sao chép ứng dụng của bạn vào container
COPY . /var/www/html

# Đặt thư mục làm việc
WORKDIR /var/www/html

# Expose port 9000 (port của PHP-FPM)
EXPOSE 9000

# CMD mặc định cho PHP-FPM
CMD ["php-fpm"]
