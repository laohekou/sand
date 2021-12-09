<?php

namespace Xyu\Sand;

use Hanson\Foundation\Http;
use Pimple\Container;
use Pimple\ServiceProviderInterface;
use Xyu\Sand\Payment\WechatMini;

class ServiceProvider implements ServiceProviderInterface
{

    public function register(Container $pimple)
    {

        $pimple['http'] = function (SandApp $app) {
            return new Http($app);
        };

        $pimple['decrypt'] = function (SandApp $app) {
            return new Decrypt($app);
        };

        $pimple['wechat_mini'] = function (SandApp $app) {
            return new WechatMini($app);
        };
    }
}