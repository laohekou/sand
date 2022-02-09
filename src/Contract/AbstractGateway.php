<?php

namespace Xyu\Sand\Contract;

use GuzzleHttp\Client;
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
    protected $relativeUrl;

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
     * Author: xyu
     */
    public function orderCreate(array $options)
    {
        return $this->structureData($options);
    }

    /**
     * 订单退款申请
     * @param array $options
     * @return array
     * Author: xyu
     */
    public function orderRefund(array $options)
    {
        return $this->structureData($options);
    }

    /**
     * 订单查询
     * @param array $options
     * @return array
     * Author: xyu
     */
    public function orderQuery(array $options)
    {
        return $this->structureData($options);
    }

    /**
     * 订单确认收货
     * @param array $options
     * @return array
     * Author: xyu
     */
    public function orderConfirmPay(array $options)
    {
        return $this->structureData($options);
    }

    /**
     * 商户自主重发异步通知
     * @param array $options
     * @return array
     * Author: xyu
     */
    public function orderMcAutoNotice(array $options)
    {
        return $this->structureData($options);
    }

    /**
     * 订单对账单申请
     * @param array $options
     * @return array
     * Author: xyu
     */
    public function clearfileDownload(array $options)
    {
        return $this->structureData($options);
    }

    /**
     * 交易结果异步通知接口
     * @param string $params
     * @return false|string
     * @throws \Throwable
     * Author: xyu
     */
    public function noticePay(string $params)
    {
        try {
            $params =
            $data = json_decode($params,true);
            $this->verify($params, $data['data']['sign']);
            return json_encode([
                'respCode' => '000000'
            ]);
        }catch (\Throwable $e) {
            throw $e;
        }
    }


    /**
     * 交易退货异步通知接口
     * @param string $params
     * @return false|string
     * @throws \Throwable
     * Author: xyu
     */
    public function noticeRefund(string $params)
    {
        try {
            $data = json_decode($params,true);
            $this->verify($params, $data['data']['sign']);
            return json_encode([
                'respCode' => '000000'
            ]);
        }catch (\Throwable $e) {
            throw $e;
        }
    }

    /**
     * 验证通知通用接口
     * @param string $data
     * @param string $sign
     * @return bool
     * @throws \Throwable
     * Author: xyu
     */
    public function verify(string $data, string $sign)
    {
        try {
            if(! $this->app->decrypt->verify($data, $sign) ) {
                return false;
            }
            return true;
        }catch (\Throwable $e) {
            throw $e;
        }
    }


    public function curlPost(array $data)
    {
        try {
            if (class_exists('Hyperf\Guzzle\CoroutineHandler')) {
                $resp = make(\Hyperf\Guzzle\ClientFactory::class)->create([
                    'timeout' => $this->app->getTimeout(),
                    'verify' => false,
                ])->post(
                    $this->app->getUrl() . $this->relativeUrl,
                    [
                        'form_params' => $data,
                        'headers' => [],
                    ]
                )->getBody()->getContents();
            }else{
                $resp = $this->app->http
                    ->setClient(
                        new Client(['timeout' => $this->app->getTimeout()])
                    )
                    ->post($this->app->getUrl() . $this->relativeUrl, $data)
                    ->getBody()->getContents();
            }
            get_logger('SAND-RESP','api-log')->info($resp);
            if($resp) {
                $result = $this->parseResult($resp);
                get_logger('SAND-RESP','api-log')->info(serialize($resp));

                return $result;
            }
            return null;
        }catch (\Throwable $e) {
            throw new \Exception('杉德接口请求失败：'. $e->getMessage());
        }
    }

    /**
     * 数据结构
     * @param array $options
     * @return array
     * Author: xyu
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
     * Author: xyu
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