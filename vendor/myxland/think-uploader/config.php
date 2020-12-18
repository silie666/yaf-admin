<?php

/**
 * 长传配置信息
 */
return [
    /**
     * 默认上传方式
     */
    'driver'    => 'aliyun',
    /**
     * 本地上传位置
     */
    'save_path' => './upload/',
    /**
     * 默认验证数据
     */
    'default'   => [
        /** limit file size,unit:byte,if the value equal 0 the file size will not restricted.  */
        'size' => 1024 * 1024,
        /** allow file extension.if is empty the file extension has no limit. */
        'ext'  => [],
        /** allow file type by file mime.if is empty the file type has no limit. */
        'type' => [],
    ],
    /**
     * 本地上传
     */
    'default'   => [
        /** access url */
        'remote_url' => 'http://xx.com/public/',
    ],
    /**
     * 七牛
     */
    'qiniu'     => [
        'access_key' => '',
        'secret_key' => '',
        'bucket'     => '',
        /** access url */
        'remote_url' => '',
    ],
    /**
     * 又拍云
     */
    'upyun'     => [
        'username'   => '',
        'password'   => '',
        'bucket'     => '',
        /** access url */
        'remote_url' => '',
    ],
    /**
     * 阿里云
     */
    'aliyun'    => [
        /** Internal net url or External net url */
        'oss_server'        => '',
        'access_key_id'     => '',
        'access_key_secret' => '',
        'bucket'            => '',
        /** access url */
        'remote_url'        => '',
    ],
];