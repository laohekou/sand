<?php

namespace Xyu\Sand\Payment;

use Xyu\Sand\Contract\AbstractGateway;
use Xyu\Sand\Exception\UnauthorizedException;
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
                    throw new UnauthorizedException('orderCreate 小程序验证签名失败', $this);
                }
            }else{
                throw new UnauthorizedException('orderCreate 小程序杉德数据失败', $this);
            }
            return json_decode($result['data'],true);
        }catch (\Throwable $e) {
            throw new $e;
        }
    }

    public function orderRefund(array $body)
    {
        $this->method = 'sandpay.trade.refund';

        $this->relativeUrl = '/gateway/api/order/refund';

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
                    throw new UnauthorizedException('orderRefund 小程序验证签名失败', $this);
                }
            }else{
                throw new UnauthorizedException('orderRefund 小程序杉德数据失败', $this);
            }
            return json_decode($result['data'],true);
        }catch (\Throwable $e) {
            throw new $e;
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
                    throw new UnauthorizedException('orderQuery 小程序验证签名失败', $this);
                }
            }else{
                throw new UnauthorizedException('orderQuery 小程序杉德数据失败', $this);
            }
            return json_decode($result['data'],true);
        }catch (\Throwable $e) {
            throw new $e;
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
                    throw new UnauthorizedException('clearfileDownload 小程序验证签名失败', $this);
                }
            }else{
                throw new UnauthorizedException('clearfileDownload 小程序杉德数据失败', $this);
            }
            return json_decode($result['data'],true);
        }catch (\Throwable $e) {
            throw new $e;
        }
    }

}