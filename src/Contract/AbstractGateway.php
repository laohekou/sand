<?php

namespace Xyu\Sand\Contract;

use Xyu\Sand\SandApp;

abstract class AbstractGateway implements GatewayInterface
{
    /**
     * @var string
     */
    protected $method;

    /**
     * @var string
     */
    protected $productId;

    /**
     * @var string
     */
    protected $channelType;

    protected $app;

    public function __construct(string $channelType, string $productId, SandApp $app)
    {
        $this->app = $app;
        $this->productId = $productId;
        $this->channelType = $channelType;
    }

    public function orderCreate(array $options)
    {
        $params = [
            'head' => [
                'version'     => '1.0',
                'method'      => $this->method,
                'productId'   => $this->productId,
                'accessType'  => $this->app->getAccessType(),
                'mid'         => $this->app->getSellerMid(),
                'plMid'       => $this->app->getPlMid(),
                'channelType' => $this->channelType,
                'reqTime'     => date('YmdHis', time()),
            ],
            'body' => $options,
        ];
        return $params;
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