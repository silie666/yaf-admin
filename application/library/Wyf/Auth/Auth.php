<?php

namespace Wyf\Auth;

use think\Db;

/**
 * ThinkCMF权限认证类
 */
class Auth
{

    /**
     * 检查权限
     * @param $name     string|array  需要验证的规则列表,支持逗号分隔的权限规则或索引数组
     * @param $uid      int           认证用户的id
     * @param $relation string    如果为 'or' 表示满足任一条规则即通过验证;如果为 'and'则表示需满足所有规则才能通过验证
     * @return boolean           通过验证返回true;失败返回false
     */
    public function check($uid, $name, $relation = 'or')
    {

        if (empty($uid)) {
            return false;
        }
        if ($uid == 1) {
            return true;
        }

        if (is_string($name)) {
            $name = strtolower($name);
            if (strpos($name, ',') !== false) {
                $name = explode(',', $name);
            } else {

                $findAuthRuleCount = Db::name('auth_rule')->where([
                    'name' => $name
                ])->count();

                if ($findAuthRuleCount == 0) {//没有规则时,不验证!
                    return true;
                }

                $name = [$name];
            }
        }

        $list   = []; //保存验证通过的规则名
        $groups = Db::name('role_user')
            ->alias("a")
            ->join('__ROLE__ r', 'a.role_id = r.id')
            ->where(["a.user_id" => $uid, "r.status" => 1])
            ->column("role_id");

        if (in_array(1, $groups)) {
            return true;
        }

        if (empty($groups)) {
            return false;
        }
        $rules = Db::name('auth_access')
            ->alias("a")
            ->join('__AUTH_RULE__ b ', ' a.rule_name = b.name')
            ->where('a.role_id', 'in', $groups)
            ->where('b.name', 'in', $name)
            ->select();
        foreach ($rules as $rule) {
            $list[] = strtolower($rule['name']);
        }

        if ($relation == 'or' and !empty($list)) {
            return true;
        }
        $diff = array_diff($name, $list);
        if ($relation == 'and' and empty($diff)) {
            return true;
        }
        return false;
    }

    /**
     * 获得用户资料
     * @param $uid
     * @return mixed
     */
    private function getUserInfo($uid)
    {
        return Db::name('user')->where('id', $uid)->find();
    }

}
