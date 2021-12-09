<?php

namespace Xyu\Sand\Payment;

use Xyu\Sand\Contract\AbstractGateway;
use Xyu\Sand\Exception\UnauthorizedException;
use Xyu\Sand\SandApp;

class AppH5 extends AbstractGateway
{
    protected $method;

    public function __construct(string $channelType, string $productId, SandApp $app)
    {
        parent::__construct($channelType, $productId, $app);
    }

    public function orderCreate(array $body)
    {
        $this->method = 'sandpay.trade.orderCreate';

        $params = parent::orderCreate($body);

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
                throw new UnauthorizedException('orderCreate H5验证签名失败');
            }
        }else{
            throw new UnauthorizedException('orderCreate H5杉德数据失败');
        }

        return json_decode($result['data'],true);
    }

    public function orderRefund(array $body)
    {
        $this->method = 'sandpay.trade.refund';

        $params = parent::orderRefund($body);

        $data = json_encode($params);

        $postData = [
            'charset'  => 'utf-8',
            'signType' => '01',
            'data'     => $data,
            'sign'     => $this->app->decrypt->sign($data)
        ];

        $resp = $this->app->http
            ->post($this->app->getUrl() . '/gw/api/order/refund', $postData)
            ->getBody()->getContents();
        $result = $this->parseResult($resp);

        if( isset($result['sign']) && isset($result['data']) ) {

            if(! $this->app->decrypt->verify($result['data'], $result['sign']) ) {
                throw new UnauthorizedException('orderRefund H5验证签名失败');
            }
        }else{
            throw new UnauthorizedException('orderRefund H5杉德数据失败');
        }

        return json_decode($result['data'],true);
    }

    public function orderQuery(array $body)
    {
        $this->method = 'sandpay.trade.query';

        $params = parent::orderQuery($body);

        $data = json_encode($params);

        $postData = [
            'charset'  => 'utf-8',
            'signType' => '01',
            'data'     => $data,
            'sign'     => $this->app->decrypt->sign($data)
        ];

        $resp = $this->app->http
            ->post($this->app->getUrl() . '/gw/api/order/query', $postData)
            ->getBody()->getContents();
        $result = $this->parseResult($resp);

        if( isset($result['sign']) && isset($result['data']) ) {

            if(! $this->app->decrypt->verify($result['data'], $result['sign']) ) {
                throw new UnauthorizedException('orderQuery H5验证签名失败');
            }
        }else{
            throw new UnauthorizedException('orderQuery H5杉德数据失败');
        }

        return json_decode($result['data'],true);
    }

    public function orderConfirmPay(array $body)
    {
        $this->method = 'sandpay.trade.confirmPay';

        $params = parent::orderConfirmPay($body);

        $data = json_encode($params);

        $postData = [
            'charset'  => 'utf-8',
            'signType' => '01',
            'data'     => $data,
            'sign'     => $this->app->decrypt->sign($data)
        ];

        $resp = $this->app->http
            ->post($this->app->getUrl() . '/gw/api/order/confirmPay', $postData)
            ->getBody()->getContents();
        $result = $this->parseResult($resp);

        if( isset($result['sign']) && isset($result['data']) ) {

            if(! $this->app->decrypt->verify($result['data'], $result['sign']) ) {
                throw new UnauthorizedException('orderConfirmPay H5验证签名失败');
            }
        }else{
            throw new UnauthorizedException('orderConfirmPay H5杉德数据失败');
        }

        return json_decode($result['data'],true);
    }

    public function orderMcAutoNotice(array $body)
    {
        $this->method = 'sandpay.trade.notify';

        $params = parent::orderMcAutoNotice($body);

        $data = json_encode($params);

        $postData = [
            'charset'  => 'utf-8',
            'signType' => '01',
            'data'     => $data,
            'sign'     => $this->app->decrypt->sign($data)
        ];

        $resp = $this->app->http
            ->post($this->app->getUrl() . '/gateway/api/order/mcAutoNotice', $postData)
            ->getBody()->getContents();
        $result = $this->parseResult($resp);

        if( isset($result['sign']) && isset($result['data']) ) {

            if(! $this->app->decrypt->verify($result['data'], $result['sign']) ) {
                throw new UnauthorizedException('orderMcAutoNotice H5验证签名失败');
            }
        }else{
            throw new UnauthorizedException('orderMcAutoNotice H5杉德数据失败');
        }

        return json_decode($result['data'],true);
    }

    public function clearfileDownload(array $body)
    {
        $this->method = 'sandpay.trade.download';

        $params = parent::clearfileDownload($body);

        $data = json_encode($params);

        $postData = [
            'charset'  => 'utf-8',
            'signType' => '01',
            'data'     => $data,
            'sign'     => $this->app->decrypt->sign($data)
        ];

        $resp = $this->app->http
            ->post($this->app->getUrl() . '/gateway/api/clearfile/download', $postData)
            ->getBody()->getContents();
        $result = $this->parseResult($resp);

        if( isset($result['sign']) && isset($result['data']) ) {

            if(! $this->app->decrypt->verify($result['data'], $result['sign']) ) {
                throw new UnauthorizedException('clearfileDownload H5验证签名失败');
            }
        }else{
            throw new UnauthorizedException('clearfileDownload H5杉德数据失败');
        }

        return json_decode($result['data'],true);
    }

}