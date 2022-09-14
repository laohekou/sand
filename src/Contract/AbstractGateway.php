<?php

namespace Xyu\Sand\Contract;

use Xyu\Sand\SandApp;
use Xyu\Sand\Traits\HttpRequests;

abstract class AbstractGateway implements GatewayInterface
{
    use HttpRequests {
        request as performRequest;
    }

    const SUCCESS = '000000';

    protected $errTraceName;

    protected $version;

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
     * @param string $data
     * @return mixed
     * @throws \Throwable
     */
    public function request(string $data)
    {
        return $this->performRequest([
            'charset'  => 'utf-8',
            'signType' => '01',
            'data'     => $data,
            'sign'     => $this->app->decrypt->sign($data)
        ]);
    }

    /**
     * 下订单
     * @param array $body
     * @return array
     */
    public function orderCreate(array $body)
    {
        return $this->structureData($body);
    }

    /**
     * 下订单
     * @param array $body
     * @return array
     */
    public function orderPay(array $body)
    {
        return $this->structureData($body);
    }

    /**
     * 订单退款申请
     * @param array $body
     * @return array
     */
    public function orderRefund(array $body)
    {
        return $this->structureData($body);
    }

    /**
     * 订单查询
     * @param array $body
     * @return array
     */
    public function orderQuery(array $body)
    {
        return $this->structureData($body);
    }

    /**
     * 订单确认收货
     * @param array $body
     * @return array
     */
    public function orderConfirmPay(array $body)
    {
        return $this->structureData($body);
    }

    /**
     * 商户自主重发异步通知
     * @param array $body
     * @return array
     */
    public function orderMcAutoNotice(array $body)
    {
        return $this->structureData($body);
    }

    /**
     * 订单对账单申请
     * @param array $body
     * @return array
     */
    public function clearfileDownload(array $body)
    {
        return $this->structureData($body);
    }

    /**
     * 交易结果异步通知接口
     * @param array $params
     * @return array
     * @throws \Throwable
     */
    public function notify(array $params): array
    {
        try {
            $data = json_decode($params['data'], true);

            if (! $this->app->decrypt->verify($params['data'], $params['sign'])) {
                throw new \Exception(($data['body']['orderCode'] ?? '') . ' 支付异步通知数据签名失败');
            }

            $respMsg = $this->respCode($data);
            if (true !== $respMsg) {
                throw new \Exception(($data['body']['orderCode'] ?? '') . $respMsg);
            }

            return [
                'params' => $params,
                'data' => $data
            ];
        } catch (\Throwable $e) {
            throw $e;
        }
    }

    public function respCode(array $data)
    {
        if (isset($data['head']['respCode']) && $data['head']['respCode'] === $this->success()) {
            return true;
        }
        return $data['head']['respMsg'] ?? '未知错误';
    }

    public function success(): string
    {
        return self::SUCCESS;
    }

    /**
     * 交易退货异步通知接口
     * @param array $params
     * @return array
     * @throws \Throwable
     */
    public function noticeRefund(array $params): array
    {
        try {
            $data = json_decode($params['data'], true);

            if (! $this->app->decrypt->verify($params['data'], $params['sign'])) {
                throw new \Exception(($data['body']['orderCode'] ?? '') . ' 交易退货异步通知签名失败');
            }

            $respMsg = $this->respCode($data);
            if (true !== $respMsg) {
                throw new \Exception(($data['body']['orderCode'] ?? '') . $respMsg);
            }

            return [
                'params' => $params,
                'data' => $data
            ];
        } catch (\Throwable $e) {
            throw $e;
        }
    }

    /**
     * 验证通知通用接口
     * @param string $data
     * @param string $sign
     * @return bool
     * @throws \Throwable
     */
    public function verify(string $data, string $sign): bool
    {
        try {
            if (!$this->app->decrypt->verify($data, $sign)) {
                return false;
            }
            return true;
        } catch (\Throwable $e) {
            throw $e;
        }
    }

    /**
     * 数据结构
     * @param array $body
     * @return array
     */
    public function structureData(array $body): array
    {
        return [
            'head' => [
                'version' => $this->getVersion() ?? '1.0',
                'method' => $this->method,
                'productId' => $this->productId,
                'accessType' => $this->app->getAccessType(),
                'mid' => $this->app->getSellerMid(),
                'plMid' => $this->app->getPlMid(),
                'channelType' => $this->channelType,
                'reqTime' => date('YmdHis', time()),
            ],
            'body' => $body,
        ];
    }

    /**
     * 杉德新收银台结构体
     * @param array $params
     * @return array
     */
    public function h5struct(array $params):array
    {
        $params['version'] = $this->getVersion() ?? '10';
        $params['product_code'] = $this->productId;
        $params['mer_no'] = $this->app->getSellerMid(); // 商户编号
        $params['mer_order_no'] = $params['orderCode']; // 商户订单号
        $params['mer_key'] = $this->app->getH5Key1(); // 商户密钥
        $params['extend'] = $params['extend'] ?? null;
        $params['extend_params'] = $params['extend_params'] ?? null;
        $params['limit_pay'] = $params['limit_pay'] ?? null;
        $params['merch_extend_params'] = $params['merch_extend_params'] ?? null;
        $params['activity_no'] = $params['activity_no'] ?? null;
        $params['benefit_amount'] = $params['benefit_amount'] ?? null;
        $params['meta_option'] = isset($params['meta_option']) ? json_encode($params['meta_option']) : json_encode([
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
        $params['expire_time'] = date('YmdHis', time() + (int)($params['expire_time'] ?? 1800));

        $params['sign'] = strtoupper(md5($this->app->decrypt->getSignContent($params) . '&key=' . $this->app->getH5Md5Key()));

        return $params;
    }

    /**
     * 响应数据解析
     * @param string $result
     * @return array
     */
    public function parseResult(string $result): array
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


    public function setVersion(string $version): AbstractGateway
    {
        $this->version = $version;
        return $this;
    }


    public function getVersion()
    {
        return $this->version;
    }


    public function sandCalculatePrice(string $price)
    {
        return \sprintf('%012d', \bcmul($price, '100'));
    }

}