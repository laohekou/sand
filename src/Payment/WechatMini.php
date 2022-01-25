<?php

namespace Xyu\Sand\Payment;

use Xyu\Sand\Contract\AbstractGateway;
use Xyu\Sand\Exception\BusinessException;
use Xyu\Sand\Exception\SandException;
use Xyu\Sand\SandApp;

class WechatMini extends AbstractGateway
{
    protected $method;

    protected $relativeUrl;

    public function __construct(string $channelType, string $productId, SandApp $app)
    {
        parent::__construct($channelType, $productId, $app);
    }

    public function orderCreate(array $body)
    {
        $this->method = 'sandpay.trade.pay';

        $this->relativeUrl = '/gateway/api/order/pay';

        $params = parent::orderCreate($body);

        try {
            $postData = [
                'charset'  => 'utf-8',
                'signType' => '01',
                'data'     => $params,
                'sign'     => $this->app->decrypt->sign(json_encode($params))
            ];
            $result = $this->curlPost($postData);
            if( isset($result['sign']) && isset($result['data']) ) {

                if(! $this->verify($result['data'], $result['sign']) ) {
                    throw new BusinessException('orderCreate 小程序验证签名失败', $this);
                }
            }else{
                throw new BusinessException('orderCreate 小程序杉德数据失败', $this);
            }
            return json_decode($result['data'],true);
        }catch (\Throwable $e) {
            $newException = $e instanceof SandException ? $e : new BusinessException(
                json_encode(['method' => $this->method, 'relativeUrl' => $this->relativeUrl, 'errMsg' => json_encode(['method' => $this->method, 'relativeUrl' => $this->relativeUrl, 'errMsg' => $e->getMessage()])]),
                $this,
                $e
            );
            throw $newException;
        }
    }

    public function orderRefund(array $body)
    {
        $this->method = 'sandpay.trade.refund';

        $this->relativeUrl = '/gateway/api/order/refund';

        $params = parent::orderRefund($body);

        try {
            $postData = [
                'charset'  => 'utf-8',
                'signType' => '01',
                'data'     => $params,
                'sign'     => $this->app->decrypt->sign(json_encode($params))
            ];
            $result = $this->curlPost($postData);
            if( isset($result['sign']) && isset($result['data']) ) {

                if(! $this->verify($result['data'], $result['sign']) ) {
                    throw new BusinessException('orderRefund 小程序验证签名失败', $this);
                }
            }else{
                throw new BusinessException('orderRefund 小程序杉德数据失败', $this);
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

        try {
            $postData = [
                'charset'  => 'utf-8',
                'signType' => '01',
                'data'     => $params,
                'sign'     => $this->app->decrypt->sign(json_encode($params))
            ];
            $result = $this->curlPost($postData);
            if( isset($result['sign']) && isset($result['data']) ) {

                if(! $this->verify($result['data'], $result['sign']) ) {
                    throw new BusinessException('orderQuery 小程序验证签名失败', $this);
                }
            }else{
                throw new BusinessException('orderQuery 小程序杉德数据失败', $this);
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

        try {
            $postData = [
                'charset'  => 'utf-8',
                'signType' => '01',
                'data'     => $params,
                'sign'     => $this->app->decrypt->sign(json_encode($params))
            ];
            $result = $this->curlPost($postData);
            if( isset($result['sign']) && isset($result['data']) ) {

                if(! $this->verify($result['data'], $result['sign']) ) {
                    throw new BusinessException('clearfileDownload 小程序验证签名失败', $this);
                }
            }else{
                throw new BusinessException('clearfileDownload 小程序杉德数据失败', $this);
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