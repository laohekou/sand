<?php

namespace Xyu\Sand;

use Hanson\Foundation\Http;
use Pimple\Container;
use Pimple\ServiceProviderInterface;
use Xyu\Sand\Payment\Alipay;
use Xyu\Sand\Payment\AppH5;
use Xyu\Sand\Payment\BankB2b;
use Xyu\Sand\Payment\BankB2c;
use Xyu\Sand\Payment\H5Quick;
use Xyu\Sand\Payment\Pc;
use Xyu\Sand\Payment\UnionPay;
use Xyu\Sand\Payment\UnionPayCode;
use Xyu\Sand\Payment\v2\H5alipay;
use Xyu\Sand\Payment\v2\H5wechatPay;
use Xyu\Sand\Payment\Wechat;
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

        $pimple['alipay'] = function (SandApp $app) {
            return new Alipay('07','00000006', $app);
        };

        $pimple['wechat'] = function (SandApp $app) {
            return new Wechat('07','00000005', $app);
        };

        $pimple['h5_quick'] = function (SandApp $app) {
            return new H5Quick('08','00000008', $app);
        };

        $pimple['bank_b2c'] = function (SandApp $app) {
            return new BankB2c('07','00000007', $app);
        };

        $pimple['bank_b2b'] = function (SandApp $app) {
            return new BankB2b('07','00000028', $app);
        };

        $pimple['union_pay_code'] = function (SandApp $app) {
            return new UnionPayCode('07','00000012', $app);
        };

        $pimple['union_pay'] = function (SandApp $app) {
            return new UnionPay('07','00000013', $app);
        };

        $pimple['h5_alipay'] = function (SandApp $app) {
            return new H5alipay('08','02020002', $app);
        };

        $pimple['h5_wechat_pay'] = function (SandApp $app) {
            return new H5wechatPay('08','02010002', $app);
        };

    }
}