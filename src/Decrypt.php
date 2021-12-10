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
        }catch (\Exception $e) {
            throw new $e;
        }
    }

    // 公钥验签
    public function verify(string $plainText, string $sign)
    {
        try {
            $publicKey = $this->app->getPublicKeyPath();
            $key = AES::publicKey($publicKey);
            return AES::verify($plainText, $key, $sign);
        }catch (\Exception $e) {
            throw new $e;
        }
    }

}