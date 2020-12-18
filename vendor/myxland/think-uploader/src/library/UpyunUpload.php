<?php

namespace myxland\uploader\library;

use Upyun\Upyun;
use Upyun\Config;

class UpyunUpload extends UploadDriverInterface
{
    protected $client;

    protected $config;

    protected $remote_url = '';

    public function __construct($config)
    {
        $this->config = new Config(
            $config['bucket'],//空间名称
            $config['username'],//用户名
            $config['password'],//密码
            $config['endpoint'],//线路
            $config['timeout']//超时时间
        );
        $this->client = new Upyun($this->config);

        $this->remote_url = isset($config['remote_url']) ? $config['remote_url'] : '';
    }

    public function upload($prefix = '', $name = null, \SplFileInfo $file)
    {
        $filename = $name ?: $file->getFilename();
        $filepath = $file->getPath() . DIRECTORY_SEPARATOR . $filename;

        $client = new Upyun($this->config);
        $ret    = $client->write($prefix . '/' . $filename, fopen($filepath, 'rb'), true);
        if (! $ret) {
            dd($ret);
            $this->setError($ret);

            return false;
        }

        @unlink($filepath);

        return $this->remote_url . $prefix . '/' . $filename;
    }
}
