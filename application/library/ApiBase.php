<?php


class ApiBase extends Yaf\Controller_Abstract
{
    public function init()
    {
        if(strtolower($this->_request->module) !== 'v1'){
            exit('错误');
        }
    }
}