<?php

namespace Xyu\Sand;

use Xyu\Sand\Support\AES;

class Decrypt
{
    protected $app;

    public function __construct(SandApp $app)
    {
        $this->app = $app;
    }

    // 私钥加签
    public function sign(string $plainText)
    {
        try {
            $privateKey = $this->app->getPrivateKeyPath();
            $privatePwdKey = $this->app->getPrivateKeyPwd();
            $pkey = AES::privateKey($privateKey,$privatePwdKey);
            return AES::sign($plainText, $pkey);
        }catch (\Throwable $e) {
            throw $e;
        }
    }

    // 公钥验签
    public function verify(string $plainText, string $sign)
    {
        try {
            $publicKey = $this->app->getPublicKeyPath();
            $key = AES::publicKey($publicKey);
            return AES::verify($plainText, $key, $sign);
        }catch (\Throwable $e) {
            throw $e;
        }
    }


    public function getSignContent(array $params):string
    {
        ksort($params);

        $stringToBeSigned = '';
        $i = 0;
        foreach ($params as $k => $v) {
            if (false === $this->checkEmpty($v) && '@' != substr($v, 0, 1)) {

                if ($i == 0) {
                    $stringToBeSigned .= "$k" . '=' . "$v";
                } else {
                    $stringToBeSigned .= '&' . "$k" . '=' . "$v";
                }
                $i++;
            }
        }

        unset ($k, $v);
        return $stringToBeSigned;
    }


    public function checkEmpty($value):bool
    {
        if (!isset($value))
            return true;
        if ($value === null)
            return true;
        if (trim($value) === '')
            return true;

        return false;
    }

}