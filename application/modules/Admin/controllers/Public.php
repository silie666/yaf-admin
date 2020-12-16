<?php
//require_once APPLICATION_PATH."/application/validate/admin/LoginValidate.php";
use Gregwar\Captcha\PhraseBuilder;
use Gregwar\Captcha\CaptchaBuilder;
use Wyf\Validate\Admin\LoginValidate;
use think\Db;
class PublicController extends AdminBase{

    public function init()
    {
    }


    public function loginAction(){
        $session = Yaf\Session::getInstance();
        $admin_id = $session->get('admin_id');
        if(!empty($admin_id)){
            $this->redirect('/admin/Index/index');
        }else{

            if(IS_POST){
                $params = input('request.');
                $vali = new LoginValidate();
                $check = $vali->scene('doLogin')->check($params);
                if(!$check){
                    api_error($vali->getError());
                }

                $code = $session->get(md5_password($params['captcha']));
                if($params['captcha']!=$code){
                    api_error('验证码错误');
                }
                $session->del(md5_password($params['captcha']));
                $where[] = array('user_type','eq',1);
                $where[] = array('user_login','eq',$params['username']);
                $info = Db::name('user')->where($where)->find();
                if(!empty($info)){
                    if($info['user_status']!= 1){
                        api_error('没有登录权限');
                    }
                    if(md5_password($params['password']) == $info['user_pass']){
                        $session->set('admin_id',$info['id']);
                        $save_data['last_login_ip'] = get_client_ip();
                        $save_data['last_login_time'] = date('Y-m-d H:i:s');
                        Db::name('user')->where($where)->update($save_data);
                        api_success('登录成功');
                    }else{
                        api_error('密码错误');
                    }
                }else{
                    api_error('用户不存在');
                }

            }else{
                $phraseBuilder = new PhraseBuilder(4, '0123456789');
                $captcha = new CaptchaBuilder(null, $phraseBuilder);
                $captcha->build();
                $session->set(md5_password($captcha->getPhrase()),$captcha->getPhrase());
                $captcha_img = base64_encode($captcha->get());
                $this->getView()->assign('captcha',$captcha_img);
                $this->displays();
            }
        }
    }
}