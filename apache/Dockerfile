##
# Created by Supun Kanushka
# Copyright (c) 2018, All Rights Reserved.
#

FROM httpd:2.4.33-alpine
RUN apk update; \
    apk upgrade;
# Copy apache vhost file to proxy php requests to php-fpm container
COPY docker-compose.apache.conf /usr/local/apache2/conf/docker-compose.apache.conf
RUN echo "Include /usr/local/apache2/conf/docker-compose.apache.conf" \
    >> /usr/local/apache2/conf/httpd.conf