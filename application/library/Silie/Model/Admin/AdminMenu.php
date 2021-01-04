<?php
namespace Silie\Model\Admin;

use think\Model;

class AdminMenu extends Model
{
    /**
     * 按父ID查找菜单子项
     * @param int     $parentId 父菜单ID
     * @param boolean $withSelf 是否包括他自己
     * @return array|string|\think\Collection
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public static function adminMenu($parentId, $withSelf = false)
    {
        //父节点ID
        $parentId = intval($parentId);
        $result   = self::where(['parent_id' => $parentId, 'status' => 1])->order("list_order", "ASC")->select();

        if ($withSelf) {
            $result2[] = self::where('id', $parentId)->find();
            $result    = array_merge($result2, $result);
        }

        //权限检查
        if (get_current_admin_id() == 1) {
            //如果是超级管理员 直接通过
            return $result;
        }

        $array = [];

        foreach ($result as $v) {

            //方法
            $action = $v['action'];

            //public开头的通过
            if (preg_match('/^public_/', $action)) {
                $array[] = $v;
            } else {

                if (preg_match('/^ajax_([a-z]+)_/', $action, $_match)) {

                    $action = $_match[1];
                }

                $ruleName = strtolower($v['app'] . "/" . $v['controller'] . "/" . $action);
//                print_r($ruleName);
                if (auth_check(get_current_admin_id(), $ruleName)) {
                    $array[] = $v;
                }

            }
        }

        return $array;
    }


    /**
     * 菜单树状结构集合
     */
    public static function menuTree()
    {
        $data = self::getTree(0);
        return $data;
    }

    /**
     * 取得树形结构的菜单
     * @param        $myId
     * @param string $parent
     * @param int    $Level
     * @return bool|null
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public static function getTree($myId, $parent = "", $Level = 1)
    {
        $data = self::adminMenu($myId);
        $Level++;
        if (count($data) > 0) {
            $ret = NULL;
            foreach ($data as $a) {
                $id         = $a['id'];
                $app        = $a['app'];
                $controller = ucwords($a['controller']);
                $action     = $a['action'];
                //附带参数
                $params = "";
                if (!empty($a['param'])) {
                    $params = htmlspecialchars_decode($a['param']);
                    $url = "/{$app}/{$controller}/{$action}?".$a['param'];
                }else{
                    $url = "/{$app}/{$controller}/{$action}";
                }
                $app = str_replace('/', '_', $app);
                $array = [
                    "icon"   => $a['icon'],
                    "id"     => $id . $app,
                    "title"   => $a['name'],
                    "parent" => $parent,
                    "href"    => $url,
                    "spread" => $a['type']
                ];


                $ret[$id . $app] = $array;
                $child           = self::getTree($a['id'], $id, $Level);
                //由于后台管理界面只支持三层，超出的不层级的不显示
                if ($child && $Level <= 3) {
                    $ret[$id . $app]['children'] = array_values($child);
                }

            }
            return $ret;
        }

        return false;
    }
}