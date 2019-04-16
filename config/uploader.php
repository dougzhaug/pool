<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Uploader云上传配置
    |--------------------------------------------------------------------------
    |
    */

    'disks' => [

        /*
         * 百度云
         */
        'bos' => [
            'driver'            => 'bos',
            'access_key_id'     =>  'xxxxxxxxxx',
            'access_key_secret' => 'xxxxxxxxxx',
            'bucket'            => 'xxx',
            'region'            =>  'gz'    //改成存储桶相应地域
        ],

        /*
         * 腾讯云
         */
        'cos' => [
            'driver'        => 'cos',
            'app_id'        => '1251908829',
            'secret_id'     => 'AKIDgHm8KOz4tdEhySpJqJfu1ynRzQjwmslX',
            'secret_key'    => 'xzraAXv9e4MTQGG9s5C94geZzLbjhZJ0',
            'bucket'        => 'manga-1251908829',
            'region'        => 'ap-hongkong'    //改成存储桶相应地域
        ],

        /*
         * 阿里云
         */
        'oss' => [
            'driver'        => 'oss',
            'access_key'    => 'LTAIFT3yxmqGFCGL',
            'secret_key'    => 'raAsIgrsy135wPBFOSbE2Lo2UTSxLs',
            'bucket'        => 'xmanga',
        ],

        /*
         * 七牛云
         */
        'qiniu' => [
            'driver'        => 'qiniu',
            'access_key'    => '9tmBBya6RJpGzhygfqVx2VYtg0SdFPLyKy3G81fI',
            'secret_key'    => '1bTRIIS6Be-uPzqf2hz0MMv8eFauZsB3ZBySQnRx',
            'bucket'        => 'xmanga',
            'domain'        => 'http://pezez1dtv.bkt.clouddn.com/'
        ],

        /*
         * 新浪云
         */
        'scs' => [
            'driver'        => 'scs',
            'access_key'    =>  'xxxxxx',
            'secret_key'    => 'xxxxxxx',
            'bucket'        => 'xxxxxxxx'
        ],

        /*
         * 又拍云
         */
        'upyun' => [
            'driver'        => 'upyun',
            'operator'      => 'xxxxx',
            'password'      => 'xxxxxx',
            'bucket'        => 'xxxxxx',
            'domain'        => 'xxxxxx',
            'form_api_secret'     =>  'xxxxx',
        ],
    ],
];