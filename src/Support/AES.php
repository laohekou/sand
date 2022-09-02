<?php

namespace Xyu\Sand\Support;

use Xyu\Sand\Exception\AesException;

class AES
{

    // 私钥加签
    public static function sign(string $plainText, string $pkey)
    {
        try {
            $resource = openssl_pkey_get_private($pkey);
            $result   = openssl_sign($plainText, $sign, $resource);
            if(PHP_VERSION < '8.0'){
                openssl_free_key($resource);
            }
            unset($resource);

            if (!$result) throw new AesException('sign error');
            return base64_encode($sign);
        } catch (\Throwable $e) {
            throw $e;
        }
    }

    // 公钥验签
    public static function verify(string $plainText, string $key, string $sign)
    {
        $resource = openssl_pkey_get_public($key);
        $result   = openssl_verify($plainText, base64_decode($sign), $resource);
        if(PHP_VERSION < '8.0'){
            openssl_free_key($resource);
        }
        unset($resource);
        if (!$result) {
            throw new AesException('公钥验签未通过,plainText:' . $plainText . '。sign:' . $sign);
        }

        return $result;
    }

    // 公钥
    public static function publicKey(string $public_key_path)
    {
        try {
            $file = file_get_contents($public_key_path);
            if (!$file) {
                throw new AesException('getPublicKey::file_get_contents ERROR');
            }
            $cert   = chunk_split(base64_encode($file), 64, "\n");
            $cert   = "-----BEGIN CERTIFICATE-----\n" . $cert . "-----END CERTIFICATE-----\n";
            $res    = openssl_pkey_get_public($cert);
            $detail = openssl_pkey_get_details($res);
            if(PHP_VERSION < '8.0'){
                openssl_free_key($res);
            }
            unset($res);
            if (!$detail) {
                throw new AesException('getPublicKey::openssl_pkey_get_details ERROR');
            }
            return $detail['key'];
        } catch (\Throwable $e) {
            throw $e;
        }
    }

    // 私钥
    public static function privateKey(string $privateKey, string $privatePwdKey)
    {
        try {
            $file = file_get_contents($privateKey);
            if (!$file) {
                throw new AesException('getPrivateKey::file_get_contents ERROR');
            }
            if (!openssl_pkcs12_read($file, $cert, $privatePwdKey)) {
                throw new AesException('getPrivateKey::openssl_pkcs12_read ERROR');
            }
            return $cert['pkey'];
        } catch (\Throwable $e) {
            throw $e;
        }
    }
}