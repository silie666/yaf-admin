<?php
header('content-type:text/html;charset=utf-8');
/* 定义这个常量是为了在application.ini中引用*/
define('APP_DEBUG',true);
define("MAGIC_QUOTES_GPC",  false);
define('APPLICATION_PATH', dirname(__FILE__)."/..");


//static
$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
$domainName = $_SERVER['HTTP_HOST'];
$host =  $protocol . $domainName;
define('__STATIC__', $host."/static");
define('__CSS__', __STATIC__."/css");
define('__JS__', __STATIC__ ."/js");
define('__IMAGES__', __STATIC__ ."/images");

//request
define('IS_POST', $_SERVER['REQUEST_METHOD'] == 'POST');
define('IS_GET', $_SERVER['REQUEST_METHOD'] == 'GET');

session_start();
$application = new Yaf\Application( APPLICATION_PATH ."/conf/application.ini");

$application->bootstrap()->run();


?>
