<?php

namespace myxland\uploader;


use myxland\uploader\library\UpyunUpload;
use myxland\uploader\library\QiniuUpload;
use myxland\uploader\library\AliyunUpload;
use myxland\uploader\library\File;
use Yaf;

class Upload
{
    /**
     * 错误信息
     *
     * @var string
     */
    protected $errors = '';

    /**
     * 图片上传的配置信息
     *
     * @var array
     */
    protected $config = [];

    /**
     * SplFileInfo
     *
     * @var null
     */
    public $file = null;

    /**
     * Create Upload Instance
     *
     * @param array $config 配置
     */
    public function __construct()
    {
        $config = (array)Yaf\Application::app()->getConfig()->uploader;
        $this->config = $config['config:protected'];
    }

    /**
     * 上传
     *
     * @param string $type 上传类型 [image, video, file]
     * @param string $field 上传的字段名
     * @param string $prefix 前缀
     * @param string $name 文件名
     * @return mixed
     */
    public function upload($type = 'default', $field = 'file', $prefix = '', $name = null)
    {
        $file = new File($_FILES[$field]['tmp_name']);
        $file->setUploadInfo($_FILES[$field]);
        $checkData = [];
        /** 大小验证 */
        if ($this->config[$type]['size'] > 0) {
            $checkData['size'] = $this->config[$type]['size'];
        }
        /** 文件后缀验证 */
        if ($this->config[$type]['ext']) {
            $checkData['ext'] = explode(',',$this->config[$type]['ext']);
        }
        if ($this->config[$type]['type']) {
            $checkData['type'] = explode(',',$this->config[$type]['type']);
        }

        /** 验证 */
        if (! $file->validate($checkData)) {
            $this->setError($file->getError());
            return false;
        }

        /** 先上传到服务器 */
        if (! $this->uploadLocal($name ?: true, $file)) {
            return false;
        }

        /** Dispatch */
        return $this->dispatch($prefix, $name, $this->file);
    }

    /**
     * 通过TP自带的上传
     *
     * @param mixed $name 上传文件名，或自动生成
     * @param \think\File $file 上传文件对象
     *
     * @return mixed
     */
    protected function uploadLocal($name = true, File $file)
    {
        $result = $file->move($this->config['save_path'], $name);


        if (! $result) {
            $this->setError($file->getError());

            return false;
        }

        $this->file = $result;

        return true;
    }

    /**
     * 上传分发
     *
     * @param string $prefix 前缀
     * @param string $name 文件名
     * @param \SplFileInfo $file 上传文件
     *
     * @return string
     */
    protected function dispatch($prefix = '', $name = null, \SplFileInfo $file)
    {
        switch ($this->config['driver']) {
            case 'qiniu':
                return $this->qiniuDriver($prefix, $name, $file);
                break;
            case 'upyun':
                return $this->upyunDriver($prefix, $name, $file);
                break;
            case 'aliyun':
                return $this->aliyunDriver($prefix, $name, $file);
                break;
            default:
                return $this->defaultDriver();
        }
    }

    /**
     * 默认驱动
     *
     * @param \SplFileInfo $file 上传文件
     *
     * @return mixed
     */
    protected function defaultDriver()
    {
        $cdn = get_option('cdn_settings')['cdn_static_root'];
        $url = $cdn.$this->config['local']['remote_dir'];

        if (substr($this->config['local']['remote_dir'], -1, 1) != '/') {
            $url .= '/';
        }

        $pathname = $this->file->getSaveName();
        if (substr($url, 0, 1) == '.') {
            $url = substr($url, 1);
        }
        if (substr($url, 0, 1) == '/') {
            $url = substr($url, 1);
        }

        $full = str_replace('\\', '/', $url . $pathname);
        return $full;
    }

    /**
     * 七牛云上传
     *
     * @param string $prefix 前缀
     * @param string $name 文件名
     * @param \SplFileInfo $file 上传文件
     *
     * @return mixed
     */
    protected function qiniuDriver($prefix = '', $name = null, \SplFileInfo $file)
    {
        $qiniu = new QiniuUpload($this->config['qiniu']);

        $result = $qiniu->upload($prefix, $name, $file);

        if (! $result) {
            $this->setError($qiniu->getError());

            return false;
        }

        return $result;
    }

    /**
     * 又拍云上传
     *
     * @param string $prefix 前缀
     * @param string $name 文件名
     * @param \SplFileInfo $file 上传文件
     *
     * @return mixed
     */
    protected function upyunDriver($prefix = '', $name = null, \SplFileInfo $file)
    {
        $upyun = new UpyunUpload($this->config['upyun']);

        $result = $upyun->upload($prefix, $name, $file);

        if (! $result) {
            $this->setError($upyun->getError());

            return false;
        }

        return $result;
    }

    /**
     * 阿里云上传驱动
     *
     * @param string $prefix 前缀
     * @param string $name 文件名
     * @param \SplFileInfo $file 上传文件
     *
     * @return mixed
     */
    protected function aliyunDriver($prefix = '', $name = null, \SplFileInfo $file)
    {
        $app = new AliyunUpload($this->config['aliyun']);

        $result = $app->upload($prefix, $name, $file);

        if (! $result) {
            $this->setError($app->getError());

            return false;
        }

        return $result;
    }

    /**
     * 设置错误
     *
     * @param void $errors
     */
    protected function setError($errors)
    {
        $this->errors = $errors;
    }

    /**
     * 获取错误信息
     *
     * @return string
     */
    public function getError()
    {
        return $this->errors;
    }
}
