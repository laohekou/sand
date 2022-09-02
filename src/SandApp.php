<?php

namespace Xyu\Sand;

use Hanson\Foundation\Foundation;
use Xyu\Sand\Payment\Alipay;
use Xyu\Sand\Payment\AppH5;
use Xyu\Sand\Payment\BankB2b;
use Xyu\Sand\Payment\BankB2c;
use Xyu\Sand\Payment\H5Quick;
use Xyu\Sand\Payment\JdPay;
use Xyu\Sand\Payment\Pc;
use Xyu\Sand\Payment\QqPay;
use Xyu\Sand\Payment\UnionPay;
use Xyu\Sand\Payment\UnionPayCode;
use Xyu\Sand\Payment\v2\H5alipay;
use Xyu\Sand\Payment\v2\H5alipayCode;
use Xyu\Sand\Payment\v2\H5wechatOfficialPay;
use Xyu\Sand\Payment\v2\H5wechatPay;
use Xyu\Sand\Payment\Wechat;
use Xyu\Sand\Payment\WechatMini;
use Xyu\Sand\Payment\WechatOfficial;

/**
 * Class SandApp
 * @package Xyu\Sand\SandApp
 *
 * @property-read Decrypt $decrypt
 * @property-read WechatMini $wechat_mini
 * @property-read WechatOfficial $wechat_official
 * @property-read AppH5 $app_h5
 * @property-read Pc $pc
 * @property-read Alipay $alipay
 * @property-read Wechat $wechat
 * @property-read H5Quick $h5_quick
 * @property-read BankB2c $bank_b2c
 * @property-read BankB2b $bank_b2b
 * @property-read UnionPayCode $union_pay_code
 * @property-read UnionPay $union_pay
 * @property-read JdPay $jd_pay
 * @property-read QqPay $qq_pay
 *
 * @property-read H5wechatOfficialPay $h5_wechat_official_pay
 * @property-read H5alipay $h5_alipay
 * @property-read H5alipayCode $h5_alipay_code
 *
 */
class SandApp extends Foundation
{
    protected $providers = [
        ServiceProvider::class,
    ];

    public function __construct($config)
    {
        if (!isset($config['debug'])) {
            $config['debug'] = $this->config['debug'] ?? false;
        }
        parent::__construct($config);
    }

    public function getTimeout()
    {
        return $this->getConfig('timeout') ?: 5;
    }

    public function getSellerMid()
    {
        return $this->getConfig('seller_mid');
    }

    public function getAccessType()
    {
        return $this->getConfig('access_type');
    }

    public function getPlMid()
    {
        return $this->getConfig('pl_mid');
    }

    public function getUrl()
    {
        return $this->getConfig('url');
    }

    public function getPrivateKeyPwd()
    {
        return $this->getConfig('private_key_pwd');
    }

    public function getPublicKeyPath()
    {
        return $this->getConfig('public_key_path');
    }

    public function getPrivateKeyPath()
    {
        return $this->getConfig('private_key_path');
    }

    public function getH5Md5Key()
    {
        return $this->getConfig('h5')['md5_key'];
    }

    public function getH5Key1()
    {
        return $this->getConfig('h5')['key1'];
    }

    public function getH5Key2()
    {
        return $this->getConfig('h5')['key2'];
    }

    public function rebind(string $id, $value)
    {
        $this->offsetUnset($id);
        $this->offsetSet($id, $value);

        return $this;
    }
}