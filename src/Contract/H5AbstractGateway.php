<?php

namespace Xyu\Sand\Contract;

use Xyu\Sand\SandApp;

abstract class H5AbstractGateway
{
    const SUCCESS = '000000';

    /**
     * @var string
     */
    protected $productCode;

    /**
     * @var string
     */
    protected $channelType;

    /**
     * @var SandApp
     */
    protected $app;

    public function __construct(string $channelType, string $productCode, SandApp $app)
    {
        $this->app = $app;
        $this->productCode = $productCode;
        $this->channelType = $channelType;
    }


    public function orderCreate(array $options)
    {
        return $this->structureData($options);
    }


    protected function structureData(array $params)
    {
        $params['version'] = '10';
        $params['product_code'] = $this->productCode;
        $params['mer_no'] = $this->app->getSellerMid(); // 商户编号
        $params['mer_order_no'] = $params['orderCode']; // 商户订单号
        $params['mer_key'] = $this->app->getH5Key1(); // 商户密钥
        $params['extend'] = $params['extend'] ?? null;
        $params['extend_params'] = $params['extend_params'] ?? null;
        $params['limit_pay'] = $params['limit_pay'] ?? null;
        $params['merch_extend_params '] = $params['merch_extend_params '] ?? null;
        $params['activity_no'] = $params['activity_no'] ?? null;
        $params['benefit_amount'] = $params['benefit_amount'] ?? null;
        $params['meta_option'] = json_encode([
            ['s' => 'Android', 'n' => '', 'id' => '', 'sc' => ''],
            ['s' => 'IOS', 'n' => '', 'id' => '', 'sc' => '']
        ]);
        $params['pay_extra'] = isset($params['pay_extra']) ? json_encode($params['pay_extra']) : '{}'; // 支付拓展域
        $params['create_ip'] = strtr($params['client_ip'], ['.' => '_']);
        $params['sign_type'] = $params['sign_type'] ?? 'MD5';
        $params['clear_cycle'] = $params['clear_cycle'] ?? '3';
        $params['jump_scheme'] = $params['jump_scheme'] ?? 'sandcash://scpay';
        $params['accsplit_flag'] = $params['accsplit_flag'] ?? 'NO';
        $params['store_id'] = $params['store_id'] ?? '000000';
        $params['create_time'] = date('YmdHis');
        $params['expire_time'] = date('YmdHis', time() + (int)$params['expire_time']);

        $temp = $params;
        unset($temp['goods_name']);
        unset($temp['jump_scheme']);
        unset($temp['expire_time']);
        unset($temp['product_code']);
        unset($temp['clear_cycle']);
        unset($temp['meta_option']);

        $params['sign'] = strtoupper(md5($this->app->decrypt->getSignContent($temp) . '&key=' . $this->app->getH5Md5Key()));

        return $params;
    }

}