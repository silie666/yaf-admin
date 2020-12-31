<?php
header('content-type:text/html;charset=utf-8');

/* 定义这个常量是为了在application.ini中引用*/
define('APP_DEBUG',true);
define("MAGIC_QUOTES_GPC",  false);
define('PROJECT_PATH', dirname(__FILE__));
define('APPLICATION_PATH', PROJECT_PATH."/..");

//static
$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
$domainName = $_SERVER['HTTP_HOST'];
$host =  $protocol . $domainName;
define('__HOST__', $host);
define('__STATIC__', __HOST__."/static");
define('__CSS__', __STATIC__."/css");
define('__JS__', __STATIC__ ."/js");
define('__IMAGES__', __STATIC__ ."/images");

//request
define('IS_POST', $_SERVER['REQUEST_METHOD'] == 'POST');
define('IS_GET', $_SERVER['REQUEST_METHOD'] == 'GET');

session_start();

$application = new Yaf\Application( APPLICATION_PATH ."/conf/admin.ini");
$application->bootstrap()->run();




?>
