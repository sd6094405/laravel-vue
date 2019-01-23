<p align="center"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## 关于项目前端页面
前台前端模板修改使用自 https://github.com/moell-peng

后端管理前端模板修改使用自 https://github.com/lin-xin/vue-manage-system

## 项目环境
基于Laravel 5.6 版本开发 

- PHP版本不能低于PHP7.1


## 初始化
*php*
 - 1.composer install
 - 2.配置文件   根目录下  cp .env.example ./.env
 - 3.需要给这两个文件夹配置读写权限：storage 目录和 bootstrap/cache 目录应该允许 Web 服务器写入，否则 Laravel 程序将无法运行。
 - 4.项目根目录执行  php artisan key:generate 刷新Key
 - 5.php artisan migrate
 - 6.php artisan db:seed
 
 *vue*
 - 1.npm install Or yarn install
 - 2.npm run watch-poll Or yarn run watch-poll
 
 *如果执行打包时出现 报错，请多打包1-2次*
## Nginx

如果你使用 Nginx 服务器，在你的站点配置中加入以下内容，它将会将所有请求引导到 index.php 前端控制器中：
```
location / {
    try_files $uri $uri/ /index.php?$query_string;
}
```