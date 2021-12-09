<?php

return [
    'debug' => env('SAND_DEBUG', true),

    'default' => env('SAND_DEFAULT_APP', 'default'),

    'drivers' => [
        'default' => [
            // 商户号
            'seller_mid' => env('SAND_SELLER_MID'),
            // 商户接入类型 1-普通商户接入 2-平台商户接入 3-核心企业商户接入
            'access_type' => env('SAND_ACCESS_TYPE'),
            // 平台ID access_type为2时必填，在担保支付模式下填写核心商户号
            'pl_mid' => env('SAND_PLMID',''),
            // 渠道类型  07-互联网  08-移动端
            'channel_type' => env('SAND_CHANNEL','08'),
            // 接口地址
            'url' => env('SAND_URL','https://cashier.sandpay.com.cn'),
            // 私钥证书密码
            'private_key_pwd' => env('SAND_PUB_KEY_PWD'),
            // 公钥文件
            'public_key_path' => env('SAND_PUB_KEY_PATH'),
            // 私钥文件
            'private_key_path' => env('SAND_PRI_KEY_PATH'),
        ]
    ],
];