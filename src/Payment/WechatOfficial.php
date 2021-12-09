<?php

namespace Xyu\Sand\Payment;

use Xyu\Sand\Contract\AbstractGateway;
use Xyu\Sand\Exception\SandException;
use Xyu\Sand\SandApp;

class WechatOfficial extends AbstractGateway
{
    protected $method;

    public function __construct(string $channelType, string $productId, SandApp $app)
    {
        parent::__construct($channelType, $productId, $app);
    }

    public function orderCreate(array $body)
    {
        $this->method = 'sandpay.trade.pay';

        $params = parent::orderCreate($body);

        $data = json_encode($params);

        $postData = [
            'charset'  => 'utf-8',
            'signType' => '01',
            'data'     => $data,
            'sign'     => $this->app->decrypt->sign($data)
        ];

        $resp = $this->app->http
            ->post($this->app->getUrl() . '/gateway/api/order/pay', $postData)
            ->getBody()->getContents();
        $result = $this->parseResult($resp);

        if( isset($result['sign']) && isset($result['data']) ) {

            if(! $this->app->decrypt->verify($result['data'], $result['sign']) ) {
                throw new SandException('orderPay 公众号验证签名失败');
            }
        }else{
            throw new SandException('orderPay 公众号杉德数据失败');
        }

        return json_decode($result['data'],true);
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