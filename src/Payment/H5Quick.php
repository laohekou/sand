<?php

namespace Xyu\Sand\Payment;

use Xyu\Sand\Contract\AbstractGateway;
use Xyu\Sand\Exception\BusinessException;
use Xyu\Sand\Exception\SandException;

/**
 * H5银行卡快捷支付
 */
class H5Quick extends AbstractGateway
{

    public function orderCreate(array $body)
    {
        try {
            $this->method = 'sandpay.trade.pay';

            $this->relativeUrl = '/gateway/api/order/pay';

            $this->errTraceName = 'H5Quick--orderCreate';

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

            $this->errTraceName = 'H5Quick--orderRefund';

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

            $this->errTraceName = 'H5Quick--orderQuery';

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

    public function orderConfirmPay(array $body)
    {
        try {
            $this->method = 'sandpay.trade.confirmPay';

            $this->relativeUrl = '/gw/api/order/confirmPay';

            $this->errTraceName = 'H5Quick--orderConfirmPay';

            return $this->request(json_encode(parent::orderConfirmPay($body)));
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

            $this->errTraceName = 'H5Quick--orderMcAutoNotice';

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

            $this->errTraceName = 'H5Quick--clearfileDownload';

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