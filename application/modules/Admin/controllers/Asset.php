<?php

use myxland\uploader\Upload;

class AssetController extends AdminBase {

    public function init()
    {

    }

    public function uploadAction(){
        $upload = new Upload();
        $url = $upload->upload();
        if($url){
            api_success('上传成功',array('url'=>$url));
        }else{
            api_error('上传失败');
        }
    }


}