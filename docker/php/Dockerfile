FROM php:8-fpm

RUN curl -sL https://deb.nodesource.com/setup_15.x | bash -
RUN curl -sL https://dl.yarnpkg.com/debian/pubkey.gpg | apt-key add -

RUN apt-get update && DEBIAN_FRONTEND=noninteractive apt-get install -y locales
RUN sed -i -e 's/# en_US.UTF-8 UTF-8/en_US.UTF-8 UTF-8/' /etc/locale.gen && \
  sed -i -e 's/# ru_RU.UTF-8 UTF-8/ru_RU.UTF-8 UTF-8/' /etc/locale.gen && \
    dpkg-reconfigure --frontend=noninteractive locales && \
    update-locale LANG=en_US.UTF-8

ENV LANG en_US.UTF-8

RUN apt-get update && apt-get install -y \
        git \
        curl \
        wget \
	    zip \
	    unzip \
	    libzip-dev \
	    nodejs yarn\
	   && rm -rf /var/lib/apt/lists/* \
       && pecl install xdebug \
       && docker-php-ext-install mysqli pdo pdo_mysql  \
       && docker-php-ext-enable xdebug


RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN wget https://get.symfony.com/cli/installer -O - | bash && mv /root/.symfony/bin/symfony /usr/local/bin/symfony

ADD php.ini /usr/local/etc/php/conf.d/40-custom.ini
ADD xdebug.ini /usr/local/etc/php/conf.d/50-xdebug-custom.ini

RUN useradd -ms /bin/bash sergey
USER sergey

CMD ["php-fpm"]