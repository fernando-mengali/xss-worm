FROM nginx:alpine
RUN rm /etc/nginx/conf.d/default.conf
COPY default.conf /etc/nginx/conf.d/default.conf
RUN mkdir -p /var/www/html
EXPOSE 80
CMD ["nginx", "-g", "daemon off;"]