FROM nginx:1.25.4-alpine3.18-perl

COPY /.deployment/docker/nginx/config/default.conf /etc/nginx/conf.d/default.conf
COPY /.deployment/docker/nginx/config/nginx.conf /etc/nginx/nginx.conf
COPY /.deployment/docker/nginx/config/.htpasswd /etc/nginx/.htpasswd
