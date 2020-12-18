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
     * 上传限制设置界面
     * @adminMenu(
     *     'name'   => '上传设置',
     *     'parent' => 'default',
     *     'display'=> true,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '上传设置',
     *     'param'  => ''
     * )
     */
    public function upload()
    {
        $uploadSetting = cmf_get_upload_setting();
        $this->assign('upload_setting', $uploadSetting);
        return $this->fetch();
    }

    /**
     * 上传限制设置界面提交
     * @adminMenu(
     *     'name'   => '上传设置提交',
     *     'parent' => 'upload',
     *     'display'=> false,
     *     'hasView'=> false,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '上传设置提交',
     *     'param'  => ''
     * )
     */
    public function uploadPost()
    {
        if ($this->request->isPost()) {
            //TODO 非空验证
            $uploadSetting = $this->request->post();

            cmf_set_option('upload_setting', $uploadSetting);
            $this->success('保存成功！','/Admin/Setting/upload');
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
    public function editWechatMsg()
    {
        if ($this->request->isPost()) {
            $data = $this->request->param();

//            $result = $this->validate($data, "AdminWxapp");
//
//            if ($result !== true) {
//                $this->error($result);
//            }

            $wxappSettings = cmf_get_option('wxapp_settings');

            $wxappSettings['wxapps'] = $data;

            cmf_set_option('wxapp_settings', $wxappSettings);

            $this->success('保存成功！');
        } else {


            $wxappSettings = cmf_get_option('wxapp_settings');

            $this->assign('wxapp', $wxappSettings['wxapps']);

            return $this->fetch();
        }
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
    public function editWechatGzhMsg()
    {
        if ($this->request->isPost()) {
            $data = $this->request->param();

            $wxappSettings = cmf_get_option('wxgzh_settings');

            $wxappSettings['wxapps'] = $data;

            cmf_set_option('wxgzh_settings', $wxappSettings);

            $this->success('保存成功！');
        } else {


            $wxappSettings = cmf_get_option('wxgzh_settings');

            $this->assign('wxapp', $wxappSettings['wxapps']);

            return $this->fetch();
        }
    }

}