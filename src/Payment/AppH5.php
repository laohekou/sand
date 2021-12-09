<?php

namespace Xyu\Sand\Payment;

use Xyu\Sand\Contract\AbstractGateway;
use Xyu\Sand\Exception\SandException;
use Xyu\Sand\SandApp;

class AppH5 extends AbstractGateway
{

    public function orderCreate(array $body)
    {
        $params = [
            'head' => [
                'version'     => '1.0',
                'method'      => 'sandpay.trade.orderCreate',
                'productId'   => '00002000',
                'accessType'  => $this->app->getAccessType(),
                'mid'         => $this->app->getSellerMid(),
                'plMid'       => $this->app->getPlMid(),
                'channelType' => $this->app->getChannelType(),
                'reqTime'     => date('YmdHis', time()),
            ],
            'body' => $body,
        ];

        $data = json_encode($params);

        $postData = [
            'charset'  => 'utf-8',
            'signType' => '01',
            'data'     => $data,
            'sign'     => $this->app->decrypt->sign($data)
        ];

        $resp = $this->app->http
            ->post($this->app->getUrl() . '/gw/web/order/create', $postData)
            ->getBody()->getContents();
        $result = $this->parseResult($resp);

        if( isset($result['sign']) && isset($result['data']) ) {

            if(! $this->app->decrypt->verify($result['data'], $result['sign']) ) {
                throw new SandException('orderCreate 小程序验证签名失败');
            }
        }else{
            throw new SandException('orderCreate 小程序杉德数据失败');
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