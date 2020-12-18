<?php

/**
 * 上传配置信息
 */
return [

    'driver'    => 'default',
    /** 上传到【public/uploads】目录 */
    'save_path' => './uploads/',

    'default' => [
        /** 文件大小,单位:byte,0为不限制 */
        'size' => 0,
        /** 允许扩展类型,空为不限制 */
        'ext'  => [],
        /** 允许的mime-type,空为不限制 */
        'type' => [],
    ],

    'local' => [
        'remote_url' => '/uploads/',
    ],
    'qiniu' => [
        'access_key' => '',
        'secret_key' => '',
        'bucket'     => '',
        /** access url */
        'remote_url' => '',
    ],

    'upyun' => [
        'username'   => '',
        'password'   => '',
        'bucket'     => '',
        /** access url */
        'remote_url' => '',
    ],

    'aliyun' => [
        /** Internal net url or External net url */
        'oss_server'        => '',
        'access_key_id'     => '',
        'access_key_secret' => '',
        'bucket'            => '',
        /** access url */
        'remote_url'        => '',
    ],
];