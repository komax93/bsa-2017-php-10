# Hometask # 10

## Project installation

Данный проект написан на базе фреймворка Laravel 5.4.*.

Для успешной установки на сервер, нужно выполнить следующие действия:

1. <strong>Склонировать проект;</strong>
2. <strong>Выполнить команду composer install в корне проекта;</strong>
3. <strong>Заполняем все данные в .env.example, после чего копируем этот файл в корень проекта с названием .env (заполняем только необходимые поля, в том числе и поля для аутентификации через Github).</strong>
4. <strong>Выполнить php artisan key:generate в корне проекта;</strong>
5. <strong>Задать права в корне проекта:</strong> sudo chgrp -R www-data storage bootstrap/cache | sudo chmod -R ug+rwx storage bootstrap/cache

## Поля, обязательные для заполнения
```
1. Нужно зарегистрировать почтовый клиент, например mailtrap, для восстановления пароля
MAIL_DRIVER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null

2. Поля для аутентификации через Github.com
GITHUB_CLIENT_ID=
GITHUB_SECRET=
GITHUB_REDIRECT=

3. Поле с адрессом сайта (нужно для прохождения тестов)
APP_URL=http://cars.dev
```

## Пример Nginx Config:

```
server {
        listen 80;
        server_name cars.dev;

        root /home/folder/develop/cars/public;
        index index.html index.htm index.php;

        charset utf-8;

        client_max_body_size 100m;

        gzip on;
        gzip_disable "msie6";
        gzip_types text/plain text/css application/json application/x-javascript text/xml application/xml application/xml+rss text/javascript application/javascript;

        location / {
                try_files $uri $uri/ /index.php?$query_string;
        }

        location ~ \.php$ {
                fastcgi_split_path_info ^(.+?\.php)(/.*)$;
                fastcgi_pass unix:/var/run/php/php7.1-fpm.sock;
                fastcgi_index index.php;
                fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
                include fastcgi_params;

                fastcgi_intercept_errors off;
                fastcgi_buffer_size 16k;
                fastcgi_buffers 4 16k;
                fastcgi_connect_timeout 75;
                fastcgi_send_timeout 300;
                fastcgi_read_timeout 300;
    }

        location ~ /\.ht {
                deny all;
        }
}
```
# Запуск тестов
1. Создайте APP_URL в .env
2. php artisan dusk
3. см. https://laravel.com/docs/5.4/dusk