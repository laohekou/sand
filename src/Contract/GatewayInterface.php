<?php

namespace Xyu\Sand\Contract;

interface GatewayInterface
{
    public function orderCreate(array $options);

    public function orderRefund(array $options);

    public function orderQuery(array $options);

    public function orderConfirmPay(array $options);

    public function orderMcAutoNotice(array $options);

    public function clearfileDownload(array $options);

}