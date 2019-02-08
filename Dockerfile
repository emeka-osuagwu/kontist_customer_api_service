FROM quay.io/hellofresh/php70:7.2

# Adds nginx configurations
ADD ./docker/nginx/default.conf   /etc/nginx/sites-available/default

# Environment variables to PHP-FPM
RUN sed -i -e "s/;clear_env\s*=\s*no/clear_env = no/g" /etc/php/7.2/fpm/pool.d/www.conf

# Set apps home directory.
ENV APP_DIR /server/http

# Adds the application code to the image
ADD . ${APP_DIR}

# Define current working directory.
WORKDIR ${APP_DIR}

RUN composer selfupdate && \
composer require "phpunit/phpunit:~5.3.4" --prefer-source --no-interaction && \
ln -s /tmp/vendor/bin/phpunit /usr/local/bin/phpunit

# Cleanup
RUN apt-get clean && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

EXPOSE 80
