# laravel-admin-Demo
作为一个php开发小鸟，在新建laravel-admin的工程的时候，踩过很过小坑。such as，数据库连接，laravel的版本，下载包的速度等等，第一次安装经过了一天的钻研才安装成功。于是在下班之际决定把安装的新工程卸载，重新走一遍流程，并记下此文及配图。希望各位技术大大多多指正，共同进步。

1、先确保是否安装composer，laravel及其版本并切换到阿里镜像
composer -v 查看composer的版本
php artisan 查看laravel的版本
composer config -g repo.packagist composerhttps://mirrors.aliyun.com/composer/


2、安装laravel-admin
1) 确认数据库连接正确，执行安装命令
composer require encore/laravel-admin (最新版本)
composer require encore/laravel-admin "1.*.*" (指定版本 如1.6.*或者1.6.10)    

2) 在config/app.php加入ServiceProvider
\Encore\Admin\AdminServiceProvider::class

3) 运行下面的命令来发布资源
php artisan vendor:publish --provider="Encore\Admin\AdminServiceProvider"
执行php artisan config:cache

4) 运行下面的命令完成安装laravel-admin
php artisan admin:install


3、安装passport
1）composer require laravel/passport

2）在config/app.php加入ServiceProvider
\Laravel\Passport\PassportServiceProvider::class

3）运行下面的命令完成安装passport
php artisan passport:install


4、安装Laravel-ide-helper提示插件
composer require barryvdh/laravel-ide-helper​​​

在config/app.php加入ServiceProvider
\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class

自动生成phpDoc
php artisan ide-helper:generate


5、安装package.json
cnpm install


6、运行php artisan serve 验证

7、打开http://localhost:8080/admin 使用admin 和admin登录验证laravel-admin后台















