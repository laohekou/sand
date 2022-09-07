<?php

namespace Xyu\Sand\Payment\v2;

use Xyu\Sand\Contract\AbstractGateway;
use Xyu\Sand\Exception\BusinessException;
use Xyu\Sand\Exception\SandException;

/**
 * H5 快捷充值
 */
class H5quickToPup extends AbstractGateway
{
    public function orderCreate(array $params)
    {
        try {

            return 'https://sandcash.mixienet.com.cn/pay/h5/quicktopup?' . http_build_query($this->h5struct($params)); // 返回支付url

        }catch (\Throwable $e) {
            $newException = $e instanceof SandException ? $e : new BusinessException(
                json_encode(['H5快捷充值','message' => $e->getMessage(),'file' => $e->getFile(),'line' => $e->getLine()]),
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
            $this->errTraceName = 'H5quickToPup--orderRefund';

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
            $this->errTraceName = 'H5quickToPup--orderQuery';

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
            $this->errTraceName = 'H5quickToPup--orderMcAutoNotice';

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
            $this->errTraceName = 'H5quickToPup--clearfileDownload';

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
}