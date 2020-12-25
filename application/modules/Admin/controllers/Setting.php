<?php


use think\Db;

/**
 * Class SettingController
 * @package app\admin\controller
 * @adminMenuRoot(
 *     'name'   =>'设置',
 *     'action' =>'default',
 *     'parent' =>'',
 *     'display'=> true,
 *     'order'  => 0,
 *     'icon'   =>'cogs',
 *     'remark' =>'系统设置入口'
 * )
 */
class SettingController extends AdminBase
{

    /**
     * 网站信息
     * @adminMenu(
     *     'name'   => '网站信息',
     *     'parent' => 'default',
     *     'display'=> true,
     *     'hasView'=> true,
     *     'order'  => 0,
     *     'icon'   => '',
     *     'remark' => '网站信息',
     *     'param'  => ''
     * )
     */
    public function siteAction()
    {
        $this->getView()->assign('site_info',get_option('site_info'));
        $this->getView()->assign("cdn_settings", get_option('cdn_settings'));
        $this->displays();
    }

    /**
     * 网站信息设置提交
     * @adminMenu(
     *     'name'   => '网站信息设置提交',
     *     'parent' => 'site',
     *     'display'=> false,
     *     'hasView'=> false,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '网站信息设置提交',
     *     'param'  => ''
     * )
     */
    public function site_postAction()
    {
        if (IS_POST) {
            $options = input('options/a');
            set_option('site_info', $options);
            $cdnSettings = input('cdn_settings/a');
            set_option('cdn_settings', $cdnSettings);
            api_success('保存成功');
        }else{
            api_error('保存失败');
        }
    }

    /**
     * 密码修改
     * @adminMenu(
     *     'name'   => '密码修改',
     *     'parent' => 'default',
     *     'display'=> false,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '密码修改',
     *     'param'  => ''
     * )
     */
    public function passwordAction()
    {
        $this->displays();
    }

    /**
     * 密码修改提交
     * @adminMenu(
     *     'name'   => '密码修改提交',
     *     'parent' => 'password',
     *     'display'=> false,
     *     'hasView'=> false,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '密码修改提交',
     *     'param'  => ''
     * )
     */
    public function password_postAction()
    {
        if (IS_POST) {
            $data = input('post.');
            if (empty($data['old_password'])) {
                api_error("原始密码不能为空！");
            }
            if (empty($data['password'])) {
                api_error("新密码不能为空！");
            }

            $userId = get_current_admin_id();

            $admin = Db::name('user')->where("id", $userId)->find();

            $oldPassword = $data['old_password'];
            $password    = $data['password'];
            $rePassword  = $data['re_password'];

            if (md5_password($oldPassword) == $admin['user_pass']) {
                if ($password == $rePassword) {
                    if (md5_password($password) ==  $admin['user_pass']) {
                        api_error('新密码不能和原始密码相同！');
                    } else {
                        Db::name('user')->where('id', $userId)->update(['user_pass' => md5_password($password)]);
                        api_success('密码修改成功!');
                    }
                } else {
                    api_error('密码输入不一致！');
                }
            } else {
                api_error('原始密码不正确！');
            }
        }
    }



    /**
     * 编辑小程序信息
     * @adminMenu(
     *     'name'   => '编辑小程序信息',
     *     'parent' => 'AdminIndex/index',
     *     'display'=> false,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '编辑小程序信息',
     *     'param'  => ''
     * )
     */
    public function edit_wechat_xcxAction()
    {
        if (IS_POST) {
            $data = input('post.');
            $wxapp_settings = get_option('wxapp_settings');
            $wxapp_settings['wxapps'] = $data;
            set_option('wxapp_settings', $wxapp_settings);
            api_success('保存成功');
        }
        $wxapp_settings = get_option('wxapp_settings');
        $this->getView()->assign('wxapp',$wxapp_settings['wxapps']);
        $this->displays();
    }



    /**
     * 编辑小程序信息
     * @adminMenu(
     *     'name'   => '编辑公众号信息',
     *     'parent' => 'AdminIndex/index',
     *     'display'=> false,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '编辑小程序信息',
     *     'param'  => ''
     * )
     */
    public function edit_wechat_gzhAction()
    {
        if (IS_POST) {
            $data = input('post.');
            $wxapp_settings = get_option('wxgzh_settings');
            $wxapp_settings['wxapps'] = $data;
            set_option('wxgzh_settings', $wxapp_settings);
            api_success('保存成功');
        }
        $wxapp_settings = get_option('wxgzh_settings');
        $this->getView()->assign('wxapp',$wxapp_settings['wxapps']);
        $this->displays();
    }

}