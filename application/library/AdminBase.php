<?php
use think\Db;

class AdminBase extends Yaf\Controller_Abstract
{
    protected $_request;

    protected $_redis;



    public function init(){
        $this->initRedis();
        $admin_id =  get_current_admin_id();
        if(!empty($admin_id)){
            $user = Db::name('user')->where('id', $admin_id)->find();
            if (!$this->checkAccess($admin_id)) {
                api_error("您没有访问权限！");
            }
            $this->getView()->assign("admin", $user);
        }else{
            $this->redirect("/admin/public/login");
        }
    }

    public function initRedis($select = 0){
        $this->_redis = redis();
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
            return auth_check($user_id,$rule);
        } else {
            return true;
        }
    }

    /**
      * Author: wyf
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
                $path = $this->_request->controller.$tpl[0];
            }else{
                $path = $tpl[0].$tpl[1];
            }
        }
        $this->getView()->display($this->getView()->getScriptPath()[0].strtolower($path).'.'.$ext);
    }

    /**
      * Author: wyf
      * Date: 2020-12-23 15:08:39
      * Description: 设置排序
      */
    protected function listOrders($model){
        $pk  = Db::name($model)->getPk();
        $ids = array_filter(input('list_orders/a'));
        if (!empty($ids)) {
            foreach ($ids as $key => $r) {
                $data['list_order'] = $r;
                Db::name($model)->where($pk, $key)->update($data);
            }
        }
        return true;
    }

}