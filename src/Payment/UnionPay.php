<?php

namespace Xyu\Sand\Payment;

use Xyu\Sand\Contract\AbstractGateway;
use Xyu\Sand\Exception\BusinessException;
use Xyu\Sand\Exception\SandException;
use Xyu\Sand\SandApp;

/**
 * ιΆθεζ«
 */
class UnionPay extends AbstractGateway
{
    protected $method;

    protected $relativeUrl;

    public function __construct(string $channelType, string $productId, SandApp $app)
    {
        parent::__construct($channelType, $productId, $app);
    }

    public function orderCreate(array $body)
    {
        $this->method = 'sandpay.trade.barpay';

        $this->relativeUrl = '/qr/api/order/pay';

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
                    throw new BusinessException('orderRefund UnionPayιͺθ―η­Ύεε€±θ΄₯', $this);
                }
            }else{
                throw new BusinessException('orderRefund UnionPayζεΎ·ζ°ζ?ε€±θ΄₯', $this);
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
                    throw new BusinessException('orderQuery UnionPayιͺθ―η­Ύεε€±θ΄₯', $this);
                }
            }else{
                throw new BusinessException('orderQuery UnionPayζεΎ·ζ°ζ?ε€±θ΄₯', $this);
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

        $this->relativeUrl = '/gateway/api/order/confirmPay';

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
                    throw new BusinessException('orderConfirmPay UnionPayιͺθ―η­Ύεε€±θ΄₯', $this);
                }
            }else{
                throw new BusinessException('orderConfirmPay UnionPayζεΎ·ζ°ζ?ε€±θ΄₯', $this);
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
                    throw new BusinessException('orderMcAutoNotice UnionPayιͺθ―η­Ύεε€±θ΄₯', $this);
                }
            }else{
                throw new BusinessException('orderMcAutoNotice UnionPayζεΎ·ζ°ζ?ε€±θ΄₯', $this);
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
                    throw new BusinessException('clearfileDownload UnionPayιͺθ―η­Ύεε€±θ΄₯', $this);
                }
            }else{
                throw new BusinessException('clearfileDownload UnionPayζεΎ·ζ°ζ?ε€±θ΄₯', $this);
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