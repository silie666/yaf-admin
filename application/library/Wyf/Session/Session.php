<?php
namespace Wyf\Session;

class Session
{
    /**
      * Author: wyf
      * Host: http://t5.test.chemm.com
      * Date: 2020-12-08 17:51:49
      * Description: 判断session是否存在
      */
    public static function has($name, $prefix = null)
    {
        $value  = $prefix ? (!empty($_SESSION[$prefix]) ? $_SESSION[$prefix] : []) : $_SESSION;
        $name = explode('.', $name);

        foreach ($name as $val) {
            if (!isset($value[$val])) {
                return false;
            } else {
                $value = $value[$val];
            }
        }

        return true;
    }

    /**
      * Author: wyf
      * Host: http://t5.test.chemm.com
      * Date: 2020-12-08 17:52:06
      * Description: 删除session
      */
    public static function delete($name, $prefix = null)
    {
        if (is_array($name)) {
            foreach ($name as $key) {
               self::delete($key, $prefix);
            }
        } elseif (strpos($name, '.')) {
            list($name1, $name2) = explode('.', $name);
            if ($prefix) {
                unset($_SESSION[$prefix][$name1][$name2]);
            } else {
                unset($_SESSION[$name1][$name2]);
            }
        } else {
            if ($prefix) {
                unset($_SESSION[$prefix][$name]);
            } else {
                unset($_SESSION[$name]);
            }
        }
    }

    /**
     * Author: wyf
     * Host: http://t5.test.chemm.com
     * Date: 2020-12-08 17:52:06
     * Description: 设置session
     */
    public static function set($name, $value, $prefix = null)
    {
        if (strpos($name, '.')) {
            // 二维数组赋值
            list($name1, $name2) = explode('.', $name);
            if ($prefix) {
                $_SESSION[$prefix][$name1][$name2] = $value;
            } else {
                $_SESSION[$name1][$name2] = $value;
            }
        } elseif ($prefix) {
            $_SESSION[$prefix][$name] = $value;
        } else {
            $_SESSION[$name] = $value;
        }
    }

    /**
      * Author: wyf
      * Host: http://t5.test.chemm.com
      * Date: 2020-12-08 17:52:22
      * Description: 获取session
      */
    public static function get($name = '', $prefix = null)
    {
        $value = $prefix ? (!empty($_SESSION[$prefix]) ? $_SESSION[$prefix] : []) : $_SESSION;
        if ('' != $name) {
            $name = explode('.', $name);
            foreach ($name as $val) {
                if (isset($value[$val])) {
                    $value = $value[$val];
                } else {
                    $value = null;
                    break;
                }
            }
        }
        return $value;
    }
}