<?php

namespace myxland\uploader\library;

use OSS\OssClient;
use OSS\Core\OssException;

class AliyunUpload extends UploadDriverInterface
{
    protected $app = null;

    protected $bucket = '';

    protected $remote_url = '';

    public function __construct($config)
    {
        $this->app = new OssClient($config['access_key_id'], $config['access_key_secret'], $config['oss_server']);

        $this->bucket = $config['bucket'];

        $this->remote_url = $config['remote_url'];

        if (substr($this->remote_url, -1, 1) != '/') {
            $this->remote_url .= '/';
        }
    }

    public function upload($prefix = '', $name = null, \SplFileInfo $file)
    {
        $filename = $name ?: $file->getFilename();

        $filepath = $file->getPath() . DIRECTORY_SEPARATOR . $filename;

        try {
            $result = $this->app->uploadFile($this->bucket, $prefix . '/' . $filename, $filepath);
        } catch (OssException $e) {
            $this->setError($e->getMessage());

            return false;
        }

        @unlink($filepath);

        return $this->remote_url . $prefix . '/' . $filename;
    }
}
