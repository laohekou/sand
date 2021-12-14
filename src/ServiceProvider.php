<?php

namespace Xyu\Sand;

use Hanson\Foundation\Http;
use Pimple\Container;
use Pimple\ServiceProviderInterface;
use Xyu\Sand\Payment\AppH5;
use Xyu\Sand\Payment\Pc;
use Xyu\Sand\Payment\WechatMini;
use Xyu\Sand\Payment\WechatOfficial;

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
            return new WechatMini('08','00002021', $app);
        };

        $pimple['wechat_official'] = function (SandApp $app) {
            return new WechatOfficial('08','00002020', $app);
        };

        $pimple['app_h5'] = function (SandApp $app) {
            return new AppH5('08','00002000', $app);
        };

        $pimple['pc'] = function (SandApp $app) {
            return new Pc('07','00002000', $app);
        };
    }
}