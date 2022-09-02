<?php

namespace Xyu\Sand\Payment\v2;

use Xyu\Sand\Contract\H5AbstractGateway;
use Xyu\Sand\Exception\BusinessException;
use Xyu\Sand\Exception\SandException;
use Xyu\Sand\SandApp;

/**
 * H5包装微信公众号
 */
class H5wechatOfficialPay extends H5AbstractGateway
{

    public function __construct(string $channelType, string $productCode, SandApp $app)
    {
        parent::__construct($channelType, $productCode, $app);
    }

    public function orderCreate(array $params)
    {
        try {
            $params = parent::orderCreate($params);

            return 'https://sandcash.mixienet.com.cn/pay/h5/wechatpay?' . http_build_query($params); // 返回支付url

        }catch (\Throwable $e) {
            $newException = $e instanceof SandException ? $e : new BusinessException(
                json_encode(['H5包装微信公众号','message' => $e->getMessage(),'file' => $e->getFile(),'line' => $e->getLine()]),
                null,
                $e
            );
            throw $newException;
        }
    }
}