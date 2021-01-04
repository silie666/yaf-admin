<?php

use think\Db;
use Silie\Tree\Tree;
use Silie\Validate\Admin\RoleValidate;
use Silie\Model\Admin\AdminMenu;

class RbacController extends AdminBase
{

    /**
      * Author: Silie
      * Date: 2020-12-25 11:57:50
      * Description: 首页
      */
    public function indexAction()
    {
        $data = Db::name('role')->order(["list_order" => "ASC", "id" => "DESC"])->select();
        $this->getView()->assign('data',json_encode($data,320));
        $this->displays();
    }

    public function editAction()
    {
        if(IS_POST){
            $data = input('post.');
            $data['menu_id'] = array_filter(explode(',',$data['menu_id']));
            if ($data['id'] == 1) {
                api_error('超级管理员角色不能被修改！');
            }
            $vali = new RoleValidate();
            if(!$vali->check($data)){
                api_error($vali->getError());
            }

            if(!empty($data['id'])){
                $res1 = Db::name('role')->strict(false)->field(true)->update($data);
            }else{
                $data['id'] = Db::name('role')->insertGetId($data);
                $res1  =true;
            }

            if (is_array($data['menu_id']) && count($data['menu_id']) > 0) {
                Db::name("auth_access")->where(array("role_id" => $data['id'], 'type' => 'admin_url'))->delete();
                foreach ($data['menu_id'] as $v) {
                    $menu = Db::name("admin_menu")->where("id", $v)->field("app,controller,action")->find();
                    if ($menu) {
                        $name   = strtolower("{$menu['app']}/{$menu['controller']}/{$menu['action']}");
                        Db::name("auth_access")->insert(["role_id" => $data['id'], "rule_name" => $name, 'type' => 'admin_url']);
                    }
                }
                $this->_redis->del($this->_redis->keys('admin_menus_*'));
                $res2 = true;
            } else {
                //当没有数据时，清除当前角色授权
                Db::name("auth_access")->where("role_id", $data['id'])->delete();
                $res2 = false;
            }


            if ($res1 !== false&&$res2!==false) {
                api_success('操作成功！');
            } elseif($res1 !== false&&$res2==true) {
                api_success('已经清空权限！');
            }else{
                api_error('操作失败！');
            }
        }

        $id = input('get.id');
        if($id){
            if ($id == 1) {
                api_error('超级管理员角色不能被修改！');
            }
            $data = Db::name('role')->where("id", $id)->find();
            if (!$data) {
                api_error('该角色不存在！');
            }
            $auth_access     = Db::name("auth_access")->where('role_id',$id)->column('rule_name');
            $admin_menu      = Db::name('admin_menu')->field('id,parent_id,type,name as title,app,controller,action')->all();
            foreach ($admin_menu as &$v){
                foreach ($auth_access as &$vv){
                    if(strtolower($vv) == strtolower("{$v['app']}/{$v['controller']}/{$v['action']}")&&$v['type']!=0){
                        $v['checked'] = true;
                    }
                }
            }
            $this->getView()->assign('info',$data);
        }else{
            $admin_menu      = Db::name('admin_menu')->field('id,parent_id,name as title,app,controller,action')->all();
        }

        $admin_menu = generateTree($admin_menu,'id','parent_id','children');



        $this->getView()->assign('menu',json_encode($admin_menu,320));
        $this->displays();
    }



    public function deleteAction()
    {
        $id = input('get.id');
        if ($id == 1) {
            api_error('超级管理员角色不能被删除！');
        }
        $count = Db::name('role_user')->where('role_id', $id)->count();
        if ($count > 0) {
            api_error('该角色已经有用户！');
        } else {
            $status = Db::name('role')->delete($id);
            if (!empty($status)) {
                api_success('删除成功！');
            } else {
                api_error('删除失败！');
            }
        }
    }

    /**
     * 设置角色权限
     * @adminMenu(
     *     'name'   => '设置角色权限',
     *     'parent' => 'index',
     *     'display'=> false,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '设置角色权限',
     *     'param'  => ''
     * )
     * @return mixed
     */
    public function authorize()
    {
        $AuthAccess     = Db::name("AuthAccess");
        $adminMenuModel = new AdminMenuModel();
        //角色ID
        $roleId = $this->request->param("id", 0, 'intval');
        if (empty($roleId)) {
            $this->error("参数错误！");
        }

        $tree       = new Tree();
        $tree->icon = ['│ ', '├─ ', '└─ '];
        $tree->nbsp = '&nbsp;&nbsp;&nbsp;';

        $result = $adminMenuModel->menuCache();

        $newMenus      = [];
        $privilegeData = $AuthAccess->where("role_id", $roleId)->column("rule_name");//获取权限表数据

        foreach ($result as $m) {
            $newMenus[$m['id']] = $m;
        }

        foreach ($result as $n => $t) {
            $result[$n]['checked']      = ($this->_isChecked($t, $privilegeData)) ? ' checked' : '';
            $result[$n]['level']        = $this->_getLevel($t['id'], $newMenus);
            $result[$n]['style']        = empty($t['parent_id']) ? '' : 'display:none;';
            $result[$n]['parentIdNode'] = ($t['parent_id']) ? ' class="child-of-node-' . $t['parent_id'] . '"' : '';
        }

        $str = "<tr id='node-\$id'\$parentIdNode  style='\$style'>
                   <td style='padding-left:30px;'>\$spacer<input type='checkbox' name='menuId[]' value='\$id' level='\$level' \$checked onclick='javascript:checknode(this);'> \$name</td>
    			</tr>";
        $tree->init($result);

        $category = $tree->getTree(0, $str);

        $this->assign("category", $category);
        $this->assign("roleId", $roleId);
        return $this->fetch();
    }

    /**
     * 角色授权提交
     * @adminMenu(
     *     'name'   => '角色授权提交',
     *     'parent' => 'index',
     *     'display'=> false,
     *     'hasView'=> false,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '角色授权提交',
     *     'param'  => ''
     * )
     * @throws \think\Exception
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     * @throws \think\exception\PDOException
     */
    public function authorizePost()
    {
        if ($this->request->isPost()) {
            $roleId = $this->request->param("roleId", 0, 'intval');
            if (!$roleId) {
                $this->error("需要授权的角色不存在！");
            }
            if (is_array($this->request->param('menuId/a')) && count($this->request->param('menuId/a')) > 0) {

                Db::name("authAccess")->where(["role_id" => $roleId, 'type' => 'admin_url'])->delete();
                foreach ($_POST['menuId'] as $menuId) {
                    $menu = Db::name("adminMenu")->where("id", $menuId)->field("app,controller,action")->find();
                    if ($menu) {
                        $app    = $menu['app'];
                        $model  = $menu['controller'];
                        $action = $menu['action'];
                        $name   = strtolower("$app/$model/$action");
                        Db::name("authAccess")->insert(["role_id" => $roleId, "rule_name" => $name, 'type' => 'admin_url']);
                    }
                }

                Cache::clear('admin_menus');// 删除后台菜单缓存

                $this->success("授权成功！");
            } else {
                //当没有数据时，清除当前角色授权
                Db::name("authAccess")->where("role_id", $roleId)->delete();
                $this->error("没有接收到数据，执行清除授权成功！");
            }
        }
    }

    /**
     * 检查指定菜单是否有权限
     * @param array $menu menu表中数组
     * @param       $privData
     * @return bool
     */
    private function _isChecked($menu, $privData)
    {
        $app    = $menu['app'];
        $model  = $menu['controller'];
        $action = $menu['action'];
        $name   = strtolower("$app/$model/$action");
        if ($privData) {
            if (in_array($name, $privData)) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }

    }

    /**
     * 获取菜单深度
     * @param       $id
     * @param array $array
     * @param int   $i
     * @return int
     */
    protected function _getLevel($id, $array = [], $i = 0)
    {
        if ($array[$id]['parent_id'] == 0 || empty($array[$array[$id]['parent_id']]) || $array[$id]['parent_id'] == $id) {
            return $i;
        } else {
            $i++;
            return $this->_getLevel($array[$id]['parent_id'], $array, $i);
        }
    }

    //角色成员管理
    public function member()
    {
        //TODO 添加角色成员管理

    }

}

