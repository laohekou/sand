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

    /**
     * @var SandApp
     */
    protected $app;

    public function __construct(string $channelType, string $productId, SandApp $app)
    {
        $this->app = $app;
        $this->productId = $productId;
        $this->channelType = $channelType;
    }

    /**
     * 下订单
     * @param array $options
     * @return array
     * Author: xiongy
     */
    public function orderCreate(array $options)
    {
        return $this->structureData($options);
    }

    /**
     * 订单退款申请
     * @param array $options
     * @return array
     * Author: xiongy
     */
    public function orderRefund(array $options)
    {
        return $this->structureData($options);
    }

    /**
     * 订单查询
     * @param array $options
     * @return array
     * Author: xiongy
     */
    public function orderQuery(array $options)
    {
        return $this->structureData($options);
    }

    /**
     * 订单确认收货
     * @param array $options
     * @return array
     * Author: xiongy
     */
    public function orderConfirmPay(array $options)
    {
        return $this->structureData($options);
    }

    /**
     * @param array $options
     * @return array
     * Author: xiongy
     */
    public function orderMcAutoNotice(array $options)
    {
        return $this->structureData($options);
    }

    /**
     * 订单对账单申请
     * @param array $options
     * @return array
     * Author: xiongy
     */
    public function clearfileDownload(array $options)
    {
        return $this->structureData($options);
    }

    /**
     * 数据结构
     * @param array $options
     * @return array
     * Author: xiongy
     */
    protected function structureData(array $options)
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

    /**
     * 响应数据解析
     * @param $result
     * @return array
     * Author: xiongy
     */
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