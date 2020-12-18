<?php

namespace myxland\uploader\library;

use Qiniu\Auth;
use Qiniu\Storage\UploadManager;

class QiniuUpload extends UploadDriverInterface
{
    protected $token = '';

    protected $remote_url = '';

    public function __construct($config)
    {
        $auth = new Auth($config['access_key'], $config['secret_key']);

        $this->token = $auth->uploadToken($config['bucket']);

        $this->remote_url = isset($config['remote_url']) ? $config['remote_url'] : '';
    }

    public function upload($prefix = '', $name = null, \SplFileInfo $file)
    {
        $filename = $name ?: $file->getFilename();

        $filepath = $file->getPath() . DIRECTORY_SEPARATOR . $filename;

        $uploadMgr = new UploadManager();

        list($ret, $err) = $uploadMgr->putFile($this->token, $prefix . '/' . $filename, $filepath);

        if ($err !== null) {

            $this->setError($err);

            return false;
        }

        @unlink($filepath);

        return $this->remote_url . $ret['key'];
    }
}
