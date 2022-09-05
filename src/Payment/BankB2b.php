<?php

namespace Xyu\Sand\Payment;

use Xyu\Sand\Contract\AbstractGateway;
use Xyu\Sand\Exception\BusinessException;
use Xyu\Sand\Exception\SandException;
use Xyu\Sand\SandApp;

/**
 * 网银B2B
 */
class BankB2b extends AbstractGateway
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

        try {
            $this->errTraceName = 'BankB2b--orderCreate';

            $structData = parent::orderCreate($body);

            return $this->request(json_encode($structData));
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
        $this->method = 'sandpay.trade.refund';

        $this->relativeUrl = '/gateway/api/order/refund';

        try {
            $this->errTraceName = 'BankB2b--orderRefund';

            $structData = parent::orderRefund($body);

            return $this->request(json_encode($structData));
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
        $this->method = 'sandpay.trade.query';

        $this->relativeUrl = '/gateway/api/order/query';

        try {
            $this->errTraceName = 'BankB2b--orderQuery';

            $structData = parent::orderQuery($body);

            return $this->request(json_encode($structData));
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
        $this->method = 'sandpay.trade.confirmPay';

        $this->relativeUrl = '/gateway/api/order/confirmPay';

        try {
            $this->errTraceName = 'BankB2b--orderConfirmPay';

            $structData = parent::orderConfirmPay($body);

            return $this->request(json_encode($structData));
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
        $this->method = 'sandpay.trade.notify';

        $this->relativeUrl = '/gateway/api/order/mcAutoNotice';

        try {
            $this->errTraceName = 'BankB2b--orderMcAutoNotice';

            $structData = parent::orderMcAutoNotice($body);

            return $this->request(json_encode($structData));
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
        $this->method = 'sandpay.trade.download';

        $this->relativeUrl = '/gateway/api/clearfile/download';

        try {
            $this->errTraceName = 'BankB2b--clearfileDownload';

            $structData = parent::clearfileDownload($body);

            return $this->request(json_encode($structData));
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