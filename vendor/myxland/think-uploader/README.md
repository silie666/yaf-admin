Thinkphp5.1 上传类
======

### 安装
~~~
composer require myxland/think-uploader:dev-master
php think uploader:config
~~~

### 用法
~~~
<?php
use myxland\uploader\Upload;

$upload = new Upload();

/**
 * 参数：
 * 1、上传类型 [image, video, file]等，需要在uploader.php中定义，参照'default'
 * 2、上传的字段名，即：form里的name
 * 3、前缀，用于云存储，文件夹分割
 * 4、文件名
 */
$result = $upload->upload();

if (!$result) {
    $this->error($upload->getError());
}
~~~