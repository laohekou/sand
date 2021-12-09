<?php

namespace Xyu\Sand\Contract;

use Xyu\Sand\Exception\SandException;
use Xyu\Sand\SandApp;

abstract class AbstractGateway implements GatewayInterface
{
    /**
     * @var string
     */
    protected $productId;

    protected $app;

    public function __construct(string $productId, SandApp $app)
    {
        $this->app = $app;
        $this->productId = $productId;
    }

    public function orderCreate(array $options)
    {
        $params = [
            'head' => [
                'version'     => '1.0',
                'method'      => 'sandpay.trade.orderCreate',
                'productId'   => $this->productId,
                'accessType'  => $this->app->getAccessType(),
                'mid'         => $this->app->getSellerMid(),
                'plMid'       => $this->app->getPlMid(),
                'channelType' => $this->app->getChannelType(),
                'reqTime'     => date('YmdHis', time()),
            ],
            'body' => $options,
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

    public function parseResult($result)
    {
        $arr = [];
        $response = urldecode($result);
        $arrStr = explode('&', $response);
        foreach ($arrStr as $str) {
            $p = strpos($str, '=');
            $key = substr($str, 0, $p);
            $value = substr($str, $p + 1);
            $arr[$key] = $value;
        }
        return $arr;
    }

}