<?php

namespace Xyu\Sand\Payment\v2;

use Xyu\Sand\Contract\AbstractGateway;
use Xyu\Sand\Exception\BusinessException;
use Xyu\Sand\Exception\SandException;
use Xyu\Sand\SandApp;

/**
 * H5端 包装支付宝码付
 */
class H5alipayCode extends AbstractGateway
{
    public function __construct(string $channelType, string $productCode, SandApp $app)
    {
        parent::__construct($channelType, $productCode, $app);
    }

    public function orderCreate(array $params)
    {
        try {
            $params = $this->h5struct($params);

            return 'https://sandcash.mixienet.com.cn/pay/h5/alipaycode?' . http_build_query($params); // 返回支付url

        }catch (\Throwable $e) {
            $newException = $e instanceof SandException ? $e : new BusinessException(
                json_encode(['H5包装支付宝码付','message' => $e->getMessage(),'file' => $e->getFile(),'line' => $e->getLine()]),
                $this,
                $e
            );
            throw $newException;
        }
    }

    public function orderRefund(array $body)
    {
        $this->method = 'sandpay.trade.refund';

        $this->relativeUrl = '/gw/api/order/refund';

        $params = parent::orderRefund($body);

        $data = json_encode($params);
        unset($params);

        try {
            $postData = [
                'charset'  => 'utf-8',
                'signType' => '01',
                'data'     => $data,
                'sign'     => $this->app->decrypt->sign($data)
            ];
            $result = $this->curlPost($postData);
            if( isset($result['sign']) && isset($result['data']) ) {

                if(! $this->verify($result['data'], $result['sign']) ) {
                    throw new BusinessException('orderRefund H5alipayCode验证签名失败', $this);
                }
            }else{
                throw new BusinessException('orderRefund H5alipayCode杉德数据失败', $this);
            }
            return json_decode($result['data'],true);
        }catch (\Throwable $e) {
            $newException = $e instanceof SandException ? $e : new BusinessException(
                json_encode(['method' => $this->method, 'relativeUrl' => $this->relativeUrl, 'errMsg' => $e->getMessage()]),
                $this,
                $e
            );
            throw $newException;
        }
    }

    public function orderQuery(array $body)
    {
        $this->method = 'sandpay.trade.query';

        $this->relativeUrl = '/gateway/api/order/query';

        $params = parent::orderQuery($body);

        $data = json_encode($params);
        unset($params);

        try {
            $postData = [
                'charset'  => 'utf-8',
                'signType' => '01',
                'data'     => $data,
                'sign'     => $this->app->decrypt->sign($data)
            ];
            $result = $this->curlPost($postData);
            if( isset($result['sign']) && isset($result['data']) ) {

                if(! $this->verify($result['data'], $result['sign']) ) {
                    throw new BusinessException('orderQuery H5alipayCode验证签名失败', $this);
                }
            }else{
                throw new BusinessException('orderQuery H5alipayCode杉德数据失败', $this);
            }
            return json_decode($result['data'],true);
        }catch (\Throwable $e) {
            $newException = $e instanceof SandException ? $e : new BusinessException(
                json_encode(['method' => $this->method, 'relativeUrl' => $this->relativeUrl, 'errMsg' => $e->getMessage()]),
                $this,
                $e
            );
            throw $newException;
        }
    }

    public function orderConfirmPay(array $body)
    {
        $this->method = 'sandpay.trade.confirmPay';

        $this->relativeUrl = '/gw/api/order/confirmPay';

        $params = parent::orderConfirmPay($body);

        $data = json_encode($params);
        unset($params);

        try {
            $postData = [
                'charset'  => 'utf-8',
                'signType' => '01',
                'data'     => $data,
                'sign'     => $this->app->decrypt->sign($data)
            ];
            $result = $this->curlPost($postData);
            if( isset($result['sign']) && isset($result['data']) ) {

                if(! $this->verify($result['data'], $result['sign']) ) {
                    throw new BusinessException('orderConfirmPay H5alipayCode验证签名失败', $this);
                }
            }else{
                throw new BusinessException('orderConfirmPay H5alipayCode杉德数据失败', $this);
            }
            return json_decode($result['data'],true);
        }catch (\Throwable $e) {
            $newException = $e instanceof SandException ? $e : new BusinessException(
                json_encode(['method' => $this->method, 'relativeUrl' => $this->relativeUrl, 'errMsg' => $e->getMessage()]),
                $this,
                $e
            );
            throw $newException;
        }
    }

    public function orderMcAutoNotice(array $body)
    {
        $this->method = 'sandpay.trade.notify';

        $this->relativeUrl = '/gateway/api/order/mcAutoNotice';

        $params = parent::orderMcAutoNotice($body);

        $data = json_encode($params);
        unset($params);

        try {
            $postData = [
                'charset'  => 'utf-8',
                'signType' => '01',
                'data'     => $data,
                'sign'     => $this->app->decrypt->sign($data)
            ];
            $result = $this->curlPost($postData);
            if( isset($result['sign']) && isset($result['data']) ) {

                if(! $this->verify($result['data'], $result['sign']) ) {
                    throw new BusinessException('orderMcAutoNotice H5alipayCode验证签名失败', $this);
                }
            }else{
                throw new BusinessException('orderMcAutoNotice H5alipayCode杉德数据失败', $this);
            }
            return json_decode($result['data'],true);
        }catch (\Throwable $e) {
            $newException = $e instanceof SandException ? $e : new BusinessException(
                json_encode(['method' => $this->method, 'relativeUrl' => $this->relativeUrl, 'errMsg' => $e->getMessage()]),
                $this,
                $e
            );
            throw $newException;
        }
    }

    public function clearfileDownload(array $body)
    {
        $this->method = 'sandpay.trade.download';

        $this->relativeUrl = '/qr/api/clearfile/download';

        $params = parent::clearfileDownload($body);

        $data = json_encode($params);
        unset($params);

        try {
            $postData = [
                'charset'  => 'utf-8',
                'signType' => '01',
                'data'     => $data,
                'sign'     => $this->app->decrypt->sign($data)
            ];
            $result = $this->curlPost($postData);
            if( isset($result['sign']) && isset($result['data']) ) {

                if(! $this->verify($result['data'], $result['sign']) ) {
                    throw new BusinessException('clearfileDownload H5alipayCode验证签名失败', $this);
                }
            }else{
                throw new BusinessException('clearfileDownload H5alipayCode杉德数据失败', $this);
            }
            return json_decode($result['data'],true);
        }catch (\Throwable $e) {
            $newException = $e instanceof SandException ? $e : new BusinessException(
                json_encode(['method' => $this->method, 'relativeUrl' => $this->relativeUrl, 'errMsg' => $e->getMessage()]),
                $this,
                $e
            );
            throw $newException;
        }
    }
}