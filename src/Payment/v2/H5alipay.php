<?php

namespace Xyu\Sand\Payment\v2;

use Xyu\Sand\Contract\H5AbstractGateway;
use Xyu\Sand\SandApp;

/**
 * H5端 支付宝支付
 */
class H5alipay extends H5AbstractGateway
{
    public function __construct(string $channelType, string $productId, SandApp $app)
    {
        parent::__construct($channelType, $productId, $app);
    }

    public function orderCreate(array $params)
    {
        try {


        }catch (\Throwable $e) {

        }
    }
}