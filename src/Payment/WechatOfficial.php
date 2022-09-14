<?php

namespace Xyu\Sand\Payment;

use Xyu\Sand\Contract\AbstractGateway;
use Xyu\Sand\Exception\BusinessException;
use Xyu\Sand\Exception\SandException;

/**
 * 微信公众号
 */
class WechatOfficial extends AbstractGateway
{

    public function orderCreate(array $body)
    {
        try {
            $this->method = 'sandpay.trade.pay';

            $this->relativeUrl = '/gateway/api/order/pay';

            $this->errTraceName = ' WechatOfficial--orderCreate';

            return $this->request(json_encode(parent::orderCreate($body)));
        }catch (\Throwable $e) {
            $newException = $e instanceof SandException ? $e : new BusinessException(
                json_encode(['method' => $this->method, 'relativeUrl' => $this->relativeUrl, 'errMsg' => $e->getMessage(), $e->getLine()]),
                $this,
                $e
            );
            throw $newException;
        }
    }

    public function orderRefund(array $body)
    {
        try {
            $this->method = 'sandpay.trade.refund';

            $this->relativeUrl = '/gateway/api/order/refund';

            $this->errTraceName = ' WechatOfficial--orderRefund';

            return $this->request(json_encode(parent::orderRefund($body)));
        }catch (\Throwable $e) {
            $newException = $e instanceof SandException ? $e : new BusinessException(
                json_encode(['method' => $this->method, 'relativeUrl' => $this->relativeUrl, 'errMsg' => $e->getMessage(), $e->getLine()]),
                $this,
                $e
            );
            throw $newException;
        }
    }

    public function orderQuery(array $body)
    {
        try {
            $this->method = 'sandpay.trade.query';

            $this->relativeUrl = '/gateway/api/order/query';

            $this->errTraceName = ' WechatOfficial--orderQuery';

            return $this->request(json_encode(parent::orderQuery($body)));
        }catch (\Throwable $e) {
            $newException = $e instanceof SandException ? $e : new BusinessException(
                json_encode(['method' => $this->method, 'relativeUrl' => $this->relativeUrl, 'errMsg' => $e->getMessage(), $e->getLine()]),
                $this,
                $e
            );
            throw $newException;
        }
    }

    public function orderMcAutoNotice(array $body)
    {
        try {
            $this->method = 'sandpay.trade.notify';

            $this->relativeUrl = '/gateway/api/order/mcAutoNotice';

            $this->errTraceName = ' WechatOfficial--orderMcAutoNotice';

            return $this->request(json_encode(parent::orderMcAutoNotice($body)));
        }catch (\Throwable $e) {
            $newException = $e instanceof SandException ? $e : new BusinessException(
                json_encode(['method' => $this->method, 'relativeUrl' => $this->relativeUrl, 'errMsg' => $e->getMessage(), $e->getLine()]),
                $this,
                $e
            );
            throw $newException;
        }
    }

    public function clearfileDownload(array $body)
    {
        try {
            $this->method = 'sandpay.trade.download';

            $this->relativeUrl = '/gateway/api/clearfile/download';

            $this->errTraceName = ' WechatOfficial--clearfileDownload';

            return $this->request(json_encode(parent::clearfileDownload($body)));
        }catch (\Throwable $e) {
            $newException = $e instanceof SandException ? $e : new BusinessException(
                json_encode(['method' => $this->method, 'relativeUrl' => $this->relativeUrl, 'errMsg' => $e->getMessage(), $e->getLine()]),
                $this,
                $e
            );
            throw $newException;
        }
    }

}