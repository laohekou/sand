<?php

namespace Xyu\Sand\Traits;

use Xyu\Sand\Exception\BusinessException;

trait HttpRequests
{

    /**
     * @param array $data
     * @return mixed
     * @throws \Throwable
     */
    public function request(array $data)
    {
        try {
            $result = $this->curlPost($data);
            if( isset($result['sign']) && isset($result['data']) ) {

                if(! $this->verify($result['data'], $result['sign']) ) {
                    throw new BusinessException($this->errTraceName . ' verify失败', $this);
                }
            }else{
                throw new BusinessException($this->errTraceName . ' 杉德数据失败', $this);
            }
            // timeStamp package paySign appId signType nonceStr 等参数返回
            return json_decode($result['data'],true);
        }catch (\Throwable $e) {
            throw $e;
        }
    }
}