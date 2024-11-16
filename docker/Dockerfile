# Sử dụng image PHP chính thức
FROM php:8.0-fpm

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
    curl \
    nano \ 
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd zip intl pdo pdo_mysql xsl

# Cài đặt các extension PHP
RUN pecl install redis mongodb \
    && docker-php-ext-enable redis mongodb

# Cài đặt Node.js và npm
RUN curl -fsSL https://deb.nodesource.com/setup_16.x | bash - \
    && apt-get install -y nodejs

# Cài đặt Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Tạo thư mục nếu chưa có
RUN mkdir -p /var/www/html/storage /var/www/html/bootstrap/cache

# Phân quyền cho các thư mục
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Sao chép ứng dụng của bạn vào container
COPY . /var/www/html

# Đặt thư mục làm việc
WORKDIR /var/www/html

# Expose port 9000 (port của PHP-FPM)
EXPOSE 9000

# CMD mặc định cho PHP-FPM
CMD ["php-fpm"]
