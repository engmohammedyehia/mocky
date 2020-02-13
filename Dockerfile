FROM firefoxegy/php7.2_nginx_xdebug_swoole
COPY . /home
WORKDIR /home
EXPOSE 9501
ENTRYPOINT [ "php", "index.php" ]
