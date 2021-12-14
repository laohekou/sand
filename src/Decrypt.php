<?php

namespace Xyu\Sand;

use Xyu\Sand\Exception\AesException;
use Xyu\Sand\Exception\SandException;
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
            $newException = $e instanceof SandException ? $e : new AesException(
                $e->getMessage(),
                $this,
                $e
            );
            throw $newException;
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
            $newException = $e instanceof SandException ? $e : new AesException(
                $e->getMessage(),
                $this,
                $e
            );
            throw $newException;
        }
    }

}