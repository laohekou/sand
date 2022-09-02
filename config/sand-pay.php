<?php

return [

    'default' => [
        // timeout
        'timeout' => 5,
        // 商户号
        'seller_mid' => env('SAND_SELLER_MID'),
        // 商户接入类型 1-普通商户接入 2-平台商户接入 3-核心企业商户接入
        'access_type' => env('SAND_ACCESS_TYPE'),
        // 平台ID access_type为2时必填，在担保支付模式下填写核心商户号
        'pl_mid' => env('SAND_PLMID',''),
        // 接口地址
        'url' => env('SAND_URL','https://cashier.sandpay.com.cn'),
        // 私钥证书密码
        'private_key_pwd' => env('SAND_PUB_KEY_PWD'),
        // 公钥文件
        'public_key_path' => env('SAND_PUB_KEY_PATH'),
        // 私钥文件
        'private_key_path' => env('SAND_PRI_KEY_PATH'),

        // 杉德新收银台
        'h5' => [
            'md5_key' => env('SAND_H5_MD5_KEY'),
            'key1' => env('SAND_H5_KEY1'),
            'key2' => env('SAND_H5_KEY2')
        ]
    ]

];
