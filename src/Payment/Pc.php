<?php

namespace Xyu\Sand\Payment;

use Xyu\Sand\Contract\AbstractGateway;
use Xyu\Sand\Exception\BusinessException;
use Xyu\Sand\Exception\SandException;
use Xyu\Sand\SandApp;

/**
 * 收银台
 */
class Pc extends AbstractGateway
{
    protected $method;

    protected $relativeUrl;

    public function __construct(string $channelType, string $productId, SandApp $app)
    {
        parent::__construct($channelType, $productId, $app);
    }

    public function orderCreate(array $body)
    {
        $this->method = 'sandpay.trade.orderCreate';

        $this->relativeUrl = '/gw/web/order/create';

        $params = parent::orderCreate($body);

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
            return $result;
        }catch (\Throwable $e) {
            $newException = $e instanceof SandException ? $e : new BusinessException(
                json_encode(['method' => $this->method, 'relativeUrl' => $this->relativeUrl, 'errMsg' => $e->getMessage()]),
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
                    throw new BusinessException('orderRefund PC验证签名失败', $this);
                }
            }else{
                throw new BusinessException('orderRefund PC杉德数据失败', $this);
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

        $this->relativeUrl = '/gw/api/order/query';

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
                    throw new BusinessException('orderQuery PC验证签名失败', $this);
                }
            }else{
                throw new BusinessException('orderQuery PC杉德数据失败', $this);
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
                    throw new BusinessException('orderConfirmPay PC验证签名失败', $this);
                }
            }else{
                throw new BusinessException('orderConfirmPay PC杉德数据失败', $this);
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
                    throw new BusinessException('orderMcAutoNotice PC验证签名失败', $this);
                }
            }else{
                throw new BusinessException('orderMcAutoNotice PC杉德数据失败', $this);
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

        $this->relativeUrl = '/gateway/api/clearfile/download';

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
                    throw new BusinessException('clearfileDownload PC验证签名失败', $this);
                }
            }else{
                throw new BusinessException('clearfileDownload PC杉德数据失败', $this);
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