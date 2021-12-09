<?php

namespace Xyu\Sand\Payment;

use Xyu\Sand\Contract\AbstractGateway;
use Xyu\Sand\Exception\SandException;
use Xyu\Sand\SandApp;

class WechatMini extends AbstractGateway
{

    public function __construct(string $productId, SandApp $app)
    {
        parent::__construct($productId, $app);

    }

    public function orderCreate(array $body)
    {

    }

    public function orderRefund(array $options)
    {

    }

    public function orderQuery(array $options)
    {

    }

    public function orderConfirmPay(array $options)
    {

    }

    public function orderMcAutoNotice(array $options)
    {

    }

    public function clearfileDownload(array $options)
    {

    }

}