# xyu/sand
杉德 sdk
杉德支付产品中心 [点击前往](https://open.sandpay.com.cn/product/index)

* 支持 `composer` 安装
* 支持 hyperf、laravel/lumen、tp 等框架

## 安装 - install

```bash
composer require xyu/sand
```

发布配置 vendor:publish
```bash
Hyperf
php bin/hyperf.php vendor:publish xyu/sand
Laravel
php artisan vendor:publish
```

```php
Hyperf  调用：
$app = sand_pay()->wechat_mini->orderCreate([]);
fpm框架 调用：
$app = sand($config)->wechat_mini->orderCreate([]);
```
