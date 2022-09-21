<?php

namespace Xyu\Sand\Payment;

use Xyu\Sand\Contract\AbstractGateway;
use Xyu\Sand\Exception\BusinessException;
use Xyu\Sand\Exception\SandException;

/**
 * 后台快捷
 */
class BackQuickPay extends AbstractGateway
{
    public function bndCard(array $body)
    {
        try {
            $this->method = 'sandPay.fastPay.apiPay.applyBindCard';

            $this->relativeUrl = '/fastPay/apiPay/applyBindCard';

            $this->errTraceName = 'BackQuickPay--bndCard';

            return $this->request(json_encode($this->structureData($body)));
        }catch (\Throwable $e) {
            $newException = $e instanceof SandException ? $e : new BusinessException(
                json_encode(['method' => $this->method, 'relativeUrl' => $this->relativeUrl, 'errMsg' => $e->getMessage(), $e->getLine()]),
                $this,
                $e
            );
            throw $newException;
        }
    }

    public function confirmBindCard(array $body)
    {
        try {
            $this->method = 'sandPay.fastPay.apiPay.confirmBindCard';

            $this->relativeUrl = '/fastPay/apiPay/confirmBindCard';

            $this->errTraceName = 'BackQuickPay--confirmBindCard';

            return $this->request(json_encode($this->structureData($body)));
        }catch (\Throwable $e) {
            $newException = $e instanceof SandException ? $e : new BusinessException(
                json_encode(['method' => $this->method, 'relativeUrl' => $this->relativeUrl, 'errMsg' => $e->getMessage(), $e->getLine()]),
                $this,
                $e
            );
            throw $newException;
        }
    }

    public function unBindCard(array $body)
    {
        try {
            $this->method = 'sandPay.fastPay.apiPay.unbindCard';

            $this->relativeUrl = '/fastPay/apiPay/unbindCard';

            $this->errTraceName = 'BackQuickPay--unBindCard';

            return $this->request(json_encode($this->structureData($body)));
        }catch (\Throwable $e) {
            $newException = $e instanceof SandException ? $e : new BusinessException(
                json_encode(['method' => $this->method, 'relativeUrl' => $this->relativeUrl, 'errMsg' => $e->getMessage(), $e->getLine()]),
                $this,
                $e
            );
            throw $newException;
        }
    }

    public function sms(array $body)
    {
        try {
            $this->method = 'sandPay.fastPay.common.sms';

            $this->relativeUrl = '/fastPay/apiPay/sms';

            $this->errTraceName = 'BackQuickPay--sms';

            return $this->request(json_encode($this->structureData($body)));
        }catch (\Throwable $e) {
            $newException = $e instanceof SandException ? $e : new BusinessException(
                json_encode(['method' => $this->method, 'relativeUrl' => $this->relativeUrl, 'errMsg' => $e->getMessage(), $e->getLine()]),
                $this,
                $e
            );
            throw $newException;
        }
    }

    public function cardQuery(array $body)
    {
        try {
            $this->method = 'sandPay.fundPay.queryBindInfo';

            $this->relativeUrl = '/fundPay/queryBindInfo';

            $this->errTraceName = 'BackQuickPay--cardQuery';

            return $this->request(json_encode($this->structureData($body)));
        }catch (\Throwable $e) {
            $newException = $e instanceof SandException ? $e : new BusinessException(
                json_encode(['method' => $this->method, 'relativeUrl' => $this->relativeUrl, 'errMsg' => $e->getMessage(), $e->getLine()]),
                $this,
                $e
            );
            throw $newException;
        }
    }

    public function orderCreate(array $body)
    {
        try {
            $this->method = 'sandPay.fastPay.apiPay.pay';

            $this->relativeUrl = '/fastPay/apiPay/pay';

            $this->errTraceName = 'BackQuickPay--orderCreate';

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

            $this->errTraceName = 'BackQuickPay--orderRefund';

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

            $this->errTraceName = 'BackQuickPay--orderQuery';

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

    public function clearfileDownload(array $body)
    {
        try {
            $this->method = 'sandpay.trade.download';

            $this->relativeUrl = '/gateway/api/clearfile/download';

            $this->errTraceName = 'BackQuickPay--clearfileDownload';

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