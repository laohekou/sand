<?php

namespace Xyu\Sand\Payment\v2;

use Xyu\Sand\Contract\AbstractGateway;
use Xyu\Sand\Exception\BusinessException;
use Xyu\Sand\Exception\SandException;

/**
 * H5快捷（WAP支付）
 */
class H5unionPay extends AbstractGateway
{
    public function orderCreate(array $params)
    {
        try {

            return 'https://sandcash.mixienet.com.cn/pay/h5/unionpayh5?' . http_build_query($this->h5struct($params)); // 返回支付url

        }catch (\Throwable $e) {
            $newException = $e instanceof SandException ? $e : new BusinessException(
                json_encode(['H5快捷（WAP支付）','message' => $e->getMessage(),'file' => $e->getFile(),'line' => $e->getLine()]),
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
            $this->errTraceName = 'H5unionPay--orderRefund';

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
            $this->errTraceName = 'H5unionPay--orderQuery';

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

    public function orderMcAutoNotice(array $body)
    {
        $this->method = 'sandpay.trade.notify';

        $this->relativeUrl = '/gateway/api/order/mcAutoNotice';

        try {
            $this->errTraceName = 'H5unionPay--orderMcAutoNotice';

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
            $this->errTraceName = 'H5unionPay--clearfileDownload';

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