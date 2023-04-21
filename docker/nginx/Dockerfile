FROM nginx:latest
RUN mkdir -p /var/www/html
ADD . /var/www/html
WORKDIR /var/www/html
ADD docker/nginx/server-dev.conf /etc/nginx/conf.d/default.conf
