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
        $params['mer_no'] = '';
        $params['mer_key'] = '';
        $params['create_ip'] = strtr($params['client_ip'], ['.' => '_']);
        $params['sign_type'] = $params['sign_type'] ?? 'MD5';
        $params['clear_cycle'] = $params['clear_cycle'] ?? '3';
        $params['jump_scheme'] = $params['jump_scheme'] ?? 'sandcash://scpay';
        $params['accsplit_flag'] = $params['accsplit_flag'] ?? 'NO';
        $params['store_id'] = $params['store_id'] ?? '000000';
        $params['create_time'] = date('YmdHis');
        $params['expire_time'] = date('YmdHis', time() + (int)$params['expire_time']);

        return $params;
    }
}