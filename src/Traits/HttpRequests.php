<?php

namespace Xyu\Sand\Traits;

use GuzzleHttp\Client;
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

                if(! $this->app->decrypt->verify($result['data'], $result['sign']) ) {
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

    /**
     * curl
     * @param array $data
     * @return array
     * @throws \Exception
     */
    public function curlPost(array $data)
    {
        try {
            $resp = $this->app->http
                ->setClient(
                    new Client([
                        \GuzzleHttp\RequestOptions::TIMEOUT  => $this->app->getTimeout(),
                        \GuzzleHttp\RequestOptions::VERIFY => \Composer\CaBundle\CaBundle::getSystemCaRootBundlePath()
                    ])
                )
                ->post($this->app->getUrl() . $this->relativeUrl, $data)
                ->getBody();
            if ($resp) {
                return $this->parseResult($resp);
            }
            return [];
        } catch (\Throwable $e) {
            throw new \Exception('杉德接口请求失败：' . $e->getMessage());
        }
    }
}