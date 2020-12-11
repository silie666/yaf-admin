<?php
use think\Db;

class AdminBase extends Yaf\Controller_Abstract
{
    protected $_request;



    public function init(){
        $session_admin_id =  Yaf\Session::getInstance()->get('admin_id');
        if(!empty($session_admin_id)){
            $user = Db::name('user')->where('id', $session_admin_id)->find();
            if (!$this->checkAccess($session_admin_id)) {
                api_error("您没有访问权限！");
            }
            $this->getView()->assign("admin", $user);
        }else{
            $this->redirect("/admin/public/login");
        }
    }



    /**
     *  检查后台用户访问权限
     * @param int $userId 后台用户id
     * @return boolean 检查通过返回true
     */
    private function checkAccess($user_id)
    {
        // 如果用户id是1，则无需判断
        if ($user_id == 1) {
            return true;
        }
        $rule       = strtolower($this->_request->uri);
        $not_require = ["admin/index/index", "admin/main/index"];
        if (!in_array($rule, $not_require)) {
            return cmf_auth_check($user_id,$rule);
        } else {
            return true;
        }
    }

    /**
      * Author: wyf
      * Host: http://t5.test.chemm.com
      * Date: 2020-12-09 16:41:07
      * Description: display
      */
    public function displays($tpl="")
    {
        $ext = Yaf\Application::app()->getConfig()->application->view->ext;
        if(empty($file)){
            $path = $this->_request->controller.'/'.$this->_request->action;
        }else{
            $tpl = explode('/',$tpl);
            if(count($tpl)==1){
                $path = $this->_request->controller.'/'.$tpl[0];
            }else{
                $path = $tpl[0].'/'.$tpl[1];
            }
        }
        $this->getView()->display($this->getView()->getScriptPath()[0].strtolower($path).'.'.$ext);
    }

}