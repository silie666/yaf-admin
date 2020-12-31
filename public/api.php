<?php
header('content-type:text/html;charset=utf-8');
/* 定义这个常量是为了在application.ini中引用*/
define('APP_DEBUG',true);
define("MAGIC_QUOTES_GPC",  false);
define('PROJECT_PATH', dirname(__FILE__));
define('APPLICATION_PATH', PROJECT_PATH."/..");

$application = new Yaf\Application( APPLICATION_PATH ."/conf/api.ini");


$application->bootstrap()->run();


?>
