# 安装laravel5.5
    composer create-project laravel/laravel hg-blog --prefer-dist "5.5.*"

# 初始化权限
    bash bin/app-init.sh
    生成如下文件:
    .storage
        ├── app
        ├── framework
        │   ├── cache
        │   ├── sessions
        │   └── views
        └── logs
    备注: 确保文件目录755读写权限

# 初始化key生成
    使用命令 php artisan key:generate  获取密码，自动保存到 .env

# nginx配置
    server {
        listen 80;
        root /web/hg-laravel5/public;

        index index.php index.html index.htm default.html;
        server_name blog.com www.blog.com *.blog.com;
        charset utf-8;

        location / {
                try_files $uri $uri/ /index.php?$query_string;
        }

        location = /favicon.ico { access_log off; log_not_found off; }
        location = /robots.txt { access_log off; log_not_found off; }

        location ~ \.php$ {
                fastcgi_pass 127.0.0.1:9000;
                fastcgi_index index.php;
                include fastcgi_params;

                fastcgi_param SCRIPT_FILENAME    $document_root$fastcgi_script_name;

                fastcgi_param APP_ENV "TESTING";#TESTING;PRODUCTION;STAGING
        }

        location ~ /\.ht {
                deny all;
        }

        location ~ .*\.(xml|gif|jpg|jpeg|png|bmp|swf|woff|woff2|ttf|js|css|mp4|mp3)$ {
                expires 30d;
        }

        error_log /web/wwwlogs/hgblog-error.log;
        access_log /web/wwwlogs/hgblog-access.log;
    }

# license
    MIT
