<?php

namespace Xyu\Sand;

use Hanson\Foundation\Http;
use Pimple\Container;
use Pimple\ServiceProviderInterface;
use Xyu\Sand\Payment\Alipay;
use Xyu\Sand\Payment\AppH5;
use Xyu\Sand\Payment\BackQuickPay;
use Xyu\Sand\Payment\BankB2b;
use Xyu\Sand\Payment\BankB2c;
use Xyu\Sand\Payment\H5Quick;
use Xyu\Sand\Payment\JdPay;
use Xyu\Sand\Payment\Pc;
use Xyu\Sand\Payment\QuickPay;
use Xyu\Sand\Payment\SandCode;
use Xyu\Sand\Payment\UnionPay;
use Xyu\Sand\Payment\UnionPayCode;
use Xyu\Sand\Payment\UnionSdkPay;
use Xyu\Sand\Payment\v2\H5alipay;
use Xyu\Sand\Payment\v2\H5alipayCode;
use Xyu\Sand\Payment\v2\H5cloud;
use Xyu\Sand\Payment\v2\H5et;
use Xyu\Sand\Payment\v2\H5fastPay;
use Xyu\Sand\Payment\v2\H5qrcode;
use Xyu\Sand\Payment\v2\H5quickToPup;
use Xyu\Sand\Payment\v2\H5sandQrcode;
use Xyu\Sand\Payment\v2\H5unionPay;
use Xyu\Sand\Payment\v2\H5wechatOfficialPay;
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

        $pimple['union_sdk_pay'] = function (SandApp $app) {
            return new UnionSdkPay('08','00000030', $app);
        };

        $pimple['jd_pay'] = function (SandApp $app) {
            return new JdPay('07','00000027', $app);
        };

        $pimple['qq_pay'] = function (SandApp $app) {
            return new JdPay('07','00000026', $app);
        };

        $pimple['quick_pay'] = function (SandApp $app) {
            return new QuickPay('07','00000016', $app);
        };

        $pimple['back_quick_pay'] = function (SandApp $app) {
            return new BackQuickPay('07','00000018', $app);
        };

        $pimple['sand_code'] = function (SandApp $app) {
            // 个人杉德宝收银台：00001000（请求产品）杉德宝-记名卡：00001001（支付工具）
            // 杉德宝个人账户余额支付：00001002（支付工具）杉德宝-快捷：00001003（支付工具）
            return new SandCode('07', $app->getProductCode() ?: '00001000', $app);
        };

        $pimple['h5_alipay'] = function (SandApp $app) {
            return new H5alipay('08','02020002', $app);
        };

        $pimple['h5_alipay_code'] = function (SandApp $app) {
            return new H5alipayCode('08','02020005', $app);
        };

        $pimple['h5_wechat_official_pay'] = function (SandApp $app) {
            return new H5wechatOfficialPay('08','02010002', $app);
        };

        $pimple['h5quick_top_up'] = function (SandApp $app) {
            return new H5quickToPup('08','06030003', $app);
        };

        $pimple['h5fast_pay'] = function (SandApp $app) {
            return new H5fastPay('08','05030001', $app);
        };

        $pimple['h5union_pay'] = function (SandApp $app) {
            return new H5unionPay('08','06030001', $app);
        };

        $pimple['h5cloud'] = function (SandApp $app) {
            // 开户账户页面product_code：00000001  消费C2B product_code：04010001
            // 担保消费(C2C)product_code：04010004 消费（C2C） product_code：04010003
            return new H5cloud('08', $app->getProductCode() ?: '00000001', $app);
        };

        $pimple['h5qrcode'] = function (SandApp $app) {
            return new H5qrcode('07','02000001', $app);
        };

        $pimple['h5sand_qrcode'] = function (SandApp $app) {
            return new H5sandQrcode('08','02040001', $app);
        };

        $pimple['h5et'] = function (SandApp $app) {
            return new H5et('08','02070001', $app);
        };
    }
}