<?php

use Wyf\Session\Session;
use Wyf\Auth\Auth;

function session($name, $value = '', $prefix = null)
{
    if (is_null($name)) {
        $_SESSION = [];
    } elseif ('' === $value) {
        // 判断或获取
        return 0 === strpos($name, '?') ? Session::has(substr($name, 1), $prefix) : Session::get($name, $prefix);
    } elseif (is_null($value)) {
        // 删除
        Session::delete($name, $prefix);
    } else {
        // 设置
        Session::set($name, $value, $prefix);
    }
}

function cmf_auth_check($user_id, $name = null, $relation = 'or')
{
    if (empty($user_id)) {
        return false;
    }

    if ($user_id == 1) {
        return true;
    }

    $authObj = new Auth();
    return $authObj->check($user_id, $name, $relation);
}

function api_result($msg = '', $data = '',$code,$http_code = 200){
    header('Content-Type:application/json; charset=utf-8');
    http_response_code($http_code);
    $result = [
        'code' => $code,
        'msg' => $msg,
        'data' => $data,
    ];
    echo json_encode($result,320);
    exit();
}

function api_success($msg = '', $data = ''){
    api_result($msg,$data,1);
}

function api_error($msg = '', $data = ''){
    api_result($msg,$data,-1);
}

function input($name,$default='',$filter=null,$datas=null) {
    static $_PUT	=	null;
    if(strpos($name,'/')){ // 指定修饰符
        list($name,$type) 	=	explode('/',$name,2);
    }else{ // 默认强制转换为字符串
        $type   =   's';
    }
    if(strpos($name,'.')) { // 指定参数来源
        list($method,$name) =   explode('.',$name,2);
    }else{ // 默认为自动判断
        $method =   'param';
    }
    switch(strtolower($method)) {
        case 'get'     :
            $input =& $_GET;
            break;
        case 'post'    :
            $input =& $_POST;
            break;
        case 'put'     :
            if(is_null($_PUT)){
                parse_str(file_get_contents('php://input'), $_PUT);
            }
            $input 	=	$_PUT;
            break;
        case 'param'   :
            switch($_SERVER['REQUEST_METHOD']) {
                case 'POST':
                    $input  =  $_POST;
                    break;
                case 'PUT':
                    if(is_null($_PUT)){
                        parse_str(file_get_contents('php://input'), $_PUT);
                    }
                    $input 	=	$_PUT;
                    break;
                default:
                    $input  =  $_GET;
            }
            break;
        case 'path'    :
            $input  =   array();
            if(!empty($_SERVER['PATH_INFO'])){
                $depr   =   '/';
                $input  =   explode($depr,trim($_SERVER['PATH_INFO'],$depr));
            }
            break;
        case 'request' :
            $input =& $_REQUEST;
            break;
        case 'session' :
            $input =& $_SESSION;
            break;
        case 'cookie'  :
            $input =& $_COOKIE;
            break;
        case 'server'  :
            $input =& $_SERVER;
            break;
        case 'globals' :
            $input =& $GLOBALS;
            break;
        case 'data'    :
            $input =& $datas;
            break;
        default:
            return null;
    }
    if(''==$name) { // 获取全部变量
        $data       =   $input;
        $filters    =   isset($filter)?$filter:Yaf\Registry::get('config')->user->default_filter;
        if($filters) {
            if(is_string($filters)){
                $filters    =   explode(',',$filters);
            }
            foreach($filters as $filter){
                $data   =   array_map_recursive($filter,$data); // 参数过滤
            }
        }

    }elseif(isset($input[$name])) { // 取值操作
        $data       =   $input[$name];
        $filters    =   isset($filter)?$filter:Yaf\Registry::get('config')->user->default_filter;
        if($filters) {
            if(is_string($filters)){
                if(0 === strpos($filters,'/')){
                    if(1 !== preg_match($filters,(string)$data)){
                        // 支持正则验证
                        return   isset($default) ? $default : null;
                    }
                }else{
                    $filters    =   explode(',',$filters);
                }
            }elseif(is_int($filters)){
                $filters    =   array($filters);
            }

            if(is_array($filters)){
                foreach($filters as $filter){
                    if(function_exists($filter)) {
                        $data   =   is_array($data) ? array_map_recursive($filter,$data) : $filter($data); // 参数过滤
                    }else{
                        $data   =   filter_var($data,is_int($filter) ? $filter : filter_id($filter));
                        if(false === $data) {
                            return   isset($default) ? $default : null;
                        }
                    }
                }
            }
        }

        if(!empty($type)){
            switch(strtolower($type)){
                case 'a':	// 数组
                    $data 	=	(array)$data;
                    break;
                case 'd':	// 数字
                    $data 	=	(int)$data;
                    break;
                case 'f':	// 浮点
                    $data 	=	(float)$data;
                    break;
                case 'b':	// 布尔
                    $data 	=	(boolean)$data;
                    break;
                case 's':   // 字符串
                default:
                    $data   =   (string)$data;
            }
        }

    }else{ // 变量默认值
        $data       =    isset($default)?$default:null;

    }
    is_array($data) && array_walk_recursive($data,'other_safe_filter');
    if(isset($data['s'])){
        unset($data['s']);
    }
    return $data;
}

/**
 * 其他安全过滤 From ThinkPHP 系统函数库 为input函数服务
 * @param $value
 */
function other_safe_filter(&$value)
{
    // TODO 其他安全过滤
    // 过滤查询特殊字符
    if (preg_match('/^(EXP|NEQ|GT|EGT|LT|ELT|OR|XOR|LIKE|NOTLIKE|NOT BETWEEN|NOTBETWEEN|BETWEEN|NOTIN|NOT IN|IN)$/i', $value)) {
        $value .= ' ';
    }
}

/**
 * 用于input函数的递归
 * @param $filter
 * @param $data
 * @return array
 */
function array_map_recursive($filter, $data)
{
    $result = array();
    foreach ($data as $key => $val) {
        $result[$key] = is_array($val)
            ? array_map_recursive($filter, $val)
            : call_user_func($filter, $val);
    }
    return $result;
}


/**
 * GET 请求 FROM wechat-php-sdk
 * @param string $url
 */
function http_get($url){
    $oCurl = curl_init();
    if(stripos($url,"https://")!==FALSE){
        curl_setopt($oCurl, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($oCurl, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($oCurl, CURLOPT_SSLVERSION, 1); //CURL_SSLVERSION_TLSv1
    }
    curl_setopt($oCurl, CURLOPT_URL, $url);
    curl_setopt($oCurl, CURLOPT_RETURNTRANSFER, 1 );
    $sContent = curl_exec($oCurl);
    $aStatus = curl_getinfo($oCurl);
    curl_close($oCurl);
    if(intval($aStatus["http_code"])==200){
        return $sContent;
    }else{
        return false;
    }
}

function http_post($url, $param, $post_file=false){
    $oCurl = curl_init();
    if (stripos($url,"https://") !== FALSE) {
        curl_setopt($oCurl, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($oCurl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($oCurl, CURLOPT_SSLVERSION, 1); //CURL_SSLVERSION_TLSv1
    }
    if (is_string($param) || $post_file) {
        $strPOST = $param;
    } else {
        $aPOST = array();
        foreach($param as $key=>$val){
            $aPOST[] = $key."=".urlencode($val);
        }
        $strPOST =  join("&", $aPOST);
    }
    curl_setopt($oCurl, CURLOPT_URL, $url);
    curl_setopt($oCurl, CURLOPT_RETURNTRANSFER, 1 );
    curl_setopt($oCurl, CURLOPT_POST,true);
    curl_setopt($oCurl, CURLOPT_POSTFIELDS,$strPOST);
    $sContent = curl_exec($oCurl);
    $aStatus = curl_getinfo($oCurl);
    curl_close($oCurl);
    if(intval($aStatus["http_code"])==200){
        return $sContent;
    }else{
        return false;
    }
}




function dump($var, $echo = true, $label = null, $flags = ENT_SUBSTITUTE)
{
    $label = (null === $label) ? '' : rtrim($label) . ':';
    ob_start();
    var_dump($var);
    $output = ob_get_clean();
    $output = preg_replace('/\]\=\>\n(\s+)/m', '] => ', $output);
    $output = '<pre>' . $label . $output . '</pre>';
    echo($output);
}

function md5_password($pw, $authCode = '')
{
    if (empty($authCode)) {
        $authCode = Yaf\Application::app()->getConfig()->database->authcode;
    }
    $result = "###" . md5(md5($authCode . $pw));
    return $result;
}

function get_client_ip($type = 0, $adv = true)
{
    $type      = $type ? 1 : 0;
    static $ip = null;

    if (null !== $ip) {
        return $ip[$type];
    }

    $httpAgentIp = 'HTTP_X_REAL_IP';

    if ($httpAgentIp && server($httpAgentIp)) {
        $ip = server($httpAgentIp);
    } elseif ($adv) {
        if (server('HTTP_X_FORWARDED_FOR')) {
            $arr = explode(',', server('HTTP_X_FORWARDED_FOR'));
            $pos = array_search('unknown', $arr);
            if (false !== $pos) {
                unset($arr[$pos]);
            }
            $ip = trim(current($arr));
        } elseif (server('HTTP_CLIENT_IP')) {
            $ip = server('HTTP_CLIENT_IP');
        } elseif (server('REMOTE_ADDR')) {
            $ip = server('REMOTE_ADDR');
        }
    } elseif (server('REMOTE_ADDR')) {
        $ip = server('REMOTE_ADDR');
    }

    // IP地址类型
    $ip_mode = (strpos($ip, ':') === false) ? 'ipv4' : 'ipv6';

    // IP地址合法验证
    if (filter_var($ip, FILTER_VALIDATE_IP) !== $ip) {
        $ip = ('ipv4' === $ip_mode) ? '0.0.0.0' : '::';
    }

    // 如果是ipv4地址，则直接使用ip2long返回int类型ip；如果是ipv6地址，暂时不支持，直接返回0
    $long_ip = ('ipv4' === $ip_mode) ? sprintf("%u", ip2long($ip)) : 0;

    $ip = [$ip, $long_ip];

    return $ip[$type];
}

function server($name = '', $default = null)
{
    if (empty($name)) {
        return $_SERVER;
    } else {
        $name = strtoupper($name);
    }
    return isset($_SERVER[$name]) ? $_SERVER[$name] : $default;
}

function get_current_admin_id()
{
    return Yaf\Session::getInstance()->get('admin_id');
}